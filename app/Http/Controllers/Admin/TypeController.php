<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class TypeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $types = Type::orderByDesc('id')->get();

        return view('admin_panel.types.type_list', [
            'types' => $types,
            'type'=>['active'=>'sudo'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin_panel.types.type_form', [
            'type' => new Type(['single' => false]),
            'formAction' => route('sudo.types.store'),
            'isEdit' => false,
            'sudo'=>13,
            'fieldOptions' => $this->getPostFieldOptions(),
            'selectedFields' => [],
            'resizeFields' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        [$validated, $resizeFields] = $this->validatedData($request);

        $type = Type::create($validated);
        $this->syncResizeFields($type, $resizeFields);

        return redirect()
            ->route('sudo.types.index')
            ->with('success', __('Type created successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type): View
    {
        $type->loadMissing('resizeFields');

        return view('admin_panel.types.type_form', [
            'type' => $type,
            'sudo'=>13,
            'formAction' => route('sudo.types.update', $type),
            'isEdit' => true,
            'fieldOptions' => $this->getPostFieldOptions(),
            'selectedFields' => $this->parseFields($type->fields),
            'resizeFields' => $type->resizeFields->map(fn ($field) => [
                'width' => $field->width,
                'height' => $field->height,
            ])->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Type $type): RedirectResponse
    {
        [$validated, $resizeFields] = $this->validatedData($request, $type);
        $type->update($validated);
        $this->syncResizeFields($type, $resizeFields);

        return redirect()
            ->route('sudo.types.index')
            ->with('success', __('Type updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type): RedirectResponse
    {
        $type->posts()->delete();
        $type->delete();

        return redirect()
            ->route('sudo.types.index')
            ->with('success', __('Type deleted successfully.'));
    }

    /**
     * Validate incoming request data for creating/updating types.
     *
     * @return array{0: array<string, mixed>, 1: array<int, array{width:int,height:int}>}
     */
    protected function validatedData(Request $request, ?Type $type = null): array
    {

        $request->merge([
            'slug' => Str::slug((string) $request->input('name')),
        ]);

        $fieldsInput = $request->input('fields');
        if (is_string($fieldsInput) && $fieldsInput !== '') {
            $request->merge([
                'fields' => $this->parseFields($fieldsInput),
            ]);
        }
        $resizeFieldsInput = $request->input('resize_fields');
        if (is_array($resizeFieldsInput)) {
            $filteredResizeFields = collect($resizeFieldsInput)
                ->map(function ($field) {
                    if (!is_array($field)) {
                        return null;
                    }

                    $width = isset($field['width']) ? trim((string) $field['width']) : '';
                    $height = isset($field['height']) ? trim((string) $field['height']) : '';

                    if ($width === '' && $height === '') {
                        return null;
                    }

                    return [
                        'width' => $width,
                        'height' => $height,
                    ];
                })
                ->filter()
                ->values()
                ->all();

            $request->merge([
                'resize_fields' => $filteredResizeFields,
            ]);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('types')->ignore($type?->id),
            ],
            'fields' => ['nullable', 'array'],
            'fields.*' => ['string'],
            'resize_fields' => ['nullable', 'array'],
            'resize_fields.*.width' => ['required_with:resize_fields', 'integer', 'min:1'],
            'resize_fields.*.height' => ['required_with:resize_fields', 'integer', 'min:1'],
            'single' => ['nullable', 'boolean'],
            'children' => ['nullable', 'string', 'max:255'],
            'active' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['single'] = $request->boolean('single');
        $fields = $validated['fields'] ?? null;
        $validated['fields'] = $this->stringifyFields(is_array($fields) ? $fields : null);
        $validated['children'] = $validated['children'] !== null ? trim($validated['children']) : null;
        $validated['active'] = $validated['active'] !== null ? trim($validated['active']) : null;

        $resizeFields = collect($validated['resize_fields'] ?? [])
        ->map(function ($field) {
            $width = isset($field['width']) ? (int) $field['width'] : null;
            $height = isset($field['height']) ? (int) $field['height'] : null;

            if ($width === null || $height === null) {
                return null;
            }

            return [
                'width' => $width,
                'height' => $height,
            ];
        })
        ->filter()
        ->values()
        ->all();

    unset($validated['resize_fields']);

    return [$validated, $resizeFields];
    }

    /**
     * Retrieve the list of selectable post fields.
     */
    protected function getPostFieldOptions(): array
    {
        return (new Post())->getFillable();
    }

    /**
     * Convert stored field string to an array.
     */
    protected function parseFields(?string $fields): array
    {
        if (empty($fields)) {
            return [];
        }

        return collect(explode(',', $fields))
            ->map(fn ($field) => trim($field, " '"))
            ->filter()
            ->values()
            ->all();
    }

    /**
     * Convert selected field array to the persisted string format.
     */
    protected function stringifyFields(?array $fields): ?string
    {
        if (empty($fields)) {
            return null;
        }

        $items = collect($fields)
            ->map(fn ($field) => trim((string) $field))
            ->filter()
            ->unique()
            ->values()
            ->map(fn ($field) => "'{$field}'")
            ->implode(',');

        return $items !== '' ? $items : null;
    }

    protected function syncResizeFields(Type $type, array $resizeFields): void
    {
        $type->resizeFields()->delete();

        if (!empty($resizeFields)) {
            $type->resizeFields()->createMany($resizeFields);
        }
    }
}
