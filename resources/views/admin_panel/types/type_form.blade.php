@extends('admin_panel.main_layout')

@section('content')
<div class="row match-height">
    <div class="col-md-12">
        <div class="card" style="min-height: 600px;">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0">
                    {{ $isEdit ? 'Type Güncelle' : 'Yeni Type Oluştur' }}
                </h3>
                <a href="{{ route('sudo.types.index') }}" class="btn btn-secondary">Geri Dön</a>
            </div>
            <div class="card-body collapse in">
                <div class="card-block" style="padding-left: 50px;padding-right: 50px;">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ $formAction }}" method="POST">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="name" class="form-control-label"><b>Adı</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $type->name) }}" required>
                            </div>
                        </div>


                        @php
                        $fieldOptions = $fieldOptions ?? [];
                        $selectedFields = collect(old('fields', $selectedFields ?? []))
                            ->map(fn ($field) => trim($field))
                            ->filter()
                            ->values()
                            ->all();

                            $resizeFieldValues = collect(old('resize_fields', $resizeFields ?? []))
                            ->map(function ($field) {
                                return [
                                    'width' => is_array($field) ? ($field['width'] ?? '') : '',
                                    'height' => is_array($field) ? ($field['height'] ?? '') : '',
                                ];
                            })
                            ->filter(function ($field) {
                                return ($field['width'] !== '') || ($field['height'] !== '');
                            })
                            ->values()
                            ->all();
                        if (empty($resizeFieldValues)) {
                            $resizeFieldValues = [['width' => '', 'height' => '']];
                        }
                    @endphp

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class="form-control-label"><b>Alanlar</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="row">
                                    @foreach ($fieldOptions as $field)
                                        @php
                                            $fieldId = 'field_' . \Illuminate\Support\Str::slug($field, '_');
                                        @endphp
                                        <div class="col-md-4 col-sm-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="fields[]" id="{{ $fieldId }}" value="{{ $field }}" {{ in_array($field, $selectedFields, true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="{{ $fieldId }}">{{ $field }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <small class="form-text text-muted">Post içerikleri için kullanılacak alanları seçin.</small>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class="form-control-label"><b>Resize Alanları</b></label>
                            </div>
                            <div class="col-12 col-md-9">

                                <div id="resize-fields-wrapper" data-count="{{ count($resizeFieldValues) }}">
                                    @foreach ($resizeFieldValues as $index => $field)
                                        <div class="resize-field-row card card-body mb-2" data-index="{{ $index }}">
                                            <div class="row g-2 align-items-end">
                                                <div class="col-md-5">
                                                    <label class="form-control-label" for="resize_width_{{ $index }}">Genişlik</label>
                                                    <input type="number" name="resize_fields[{{ $index }}][width]" id="resize_width_{{ $index }}" class="form-control" value="{{ $field['width'] }}" min="1" placeholder="Örn: 300">
                                                </div>
                                                <div class="col-md-5">
                                                    <label class="form-control-label" for="resize_height_{{ $index }}">Yükseklik</label>
                                                    <input type="number" name="resize_fields[{{ $index }}][height]" id="resize_height_{{ $index }}" class="form-control" value="{{ $field['height'] }}" min="1" placeholder="Örn: 300">
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" class="btn btn-outline-danger w-100" data-action="remove-resize-field">Sil</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="add-resize-field">Resize Alanı Ekle</button>
                                <small class="form-text text-muted">Her satır, üretilecek bir görsel boyutunu temsil eder.</small>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class="form-control-label"><b>Single</b></label>
                            </div>
                            <div class="col-12 col-md-9 d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="single" id="single" value="1" {{ old('single', $type->single) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="single">Tekil içerik</label>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="children" class="form-control-label"><b>Children</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="children" id="children" class="form-control" value="{{ old('children', $type->children) }}" placeholder="Alt içerik tipi (varsa)">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="active" class="form-control-label"><b>Active Tab</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="active" id="active" class="form-control" value="{{ old('active', $type->active) }}" placeholder="Varsayılan aktif sekme (isteğe bağlı)">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3"></div>
                            <div class="col-12 col-md-9">
                                <button type="submit" class="btn btn-primary" style="width: 300px;">
                                    {{ $isEdit ? 'Güncelle' : 'Kaydet' }}
                                </button>
                            </div>
                        </div>
                        <template id="resize-field-template">
                            <div class="resize-field-row card card-body mb-2" data-index="__INDEX__">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-5">
                                        <label class="form-control-label" for="resize_width___INDEX__">Genişlik</label>
                                        <input type="number" name="resize_fields[__INDEX__][width]" id="resize_width___INDEX__" class="form-control" min="1" placeholder="Örn: 300">
                                    </div>
                                    <div class="col-md-5">
                                        <label class="form-control-label" for="resize_height___INDEX__">Yükseklik</label>
                                        <input type="number" name="resize_fields[__INDEX__][height]" id="resize_height___INDEX__" class="form-control" min="1" placeholder="Örn: 300">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-outline-danger w-100" data-action="remove-resize-field">Sil</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function () {
        const wrapper = document.getElementById('resize-fields-wrapper');
        if (!wrapper) {
            return;
        }

        const template = document.getElementById('resize-field-template');
        const addButton = document.getElementById('add-resize-field');
        let counter = Number(wrapper.dataset.count || 0);

        const createRow = () => {
            if (!template) {
                return;
            }

            const content = template.innerHTML.replace(/__INDEX__/g, counter);
            counter += 1;

            const container = document.createElement('div');
            container.innerHTML = content.trim();
            const row = container.firstElementChild;
            if (row) {
                wrapper.appendChild(row);
            }
        };

        addButton?.addEventListener('click', (event) => {
            event.preventDefault();
            createRow();
        });

        wrapper.addEventListener('click', (event) => {
            const target = event.target;
            if (!(target instanceof HTMLElement)) {
                return;
            }

            if (target.matches('[data-action="remove-resize-field"]')) {
                event.preventDefault();
                const row = target.closest('.resize-field-row');
                if (row) {
                    row.remove();
                }
            }
        });
    })();
</script>
@endsection
