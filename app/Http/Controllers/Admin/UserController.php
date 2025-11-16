<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keyword;
use App\Models\Type;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Illuminate\View\View;
class UserController extends Controller
{
    public function index(): View
    {
        $users = User::where('role_id', 4)
            ->orderByDesc('id')
            ->get();

        return view('admin_panel.users.user_list', [
            'users' => $users,
            'type' => $this->menuType(),
        ]);
    }

    public function create(): View
    {
        return view('admin_panel.users.user_form', [
            'user' => new User(['role_id' => 4]),
            'type' => $this->menuType(),
            'formAction' => route('Users.store'),
            'isEdit' => false,
            'userSettings' => new UserSetting(),
            'allKeywords' => Keyword::orderBy('name')->get(),
            'selectedKeywords' => [],
            'addresses' => collect(),
        ]);
    }

    public function store(Request $request)
    {
        return $this->upsertUser($request, new User());
    }

    public function edit(User $User): View
    {
        if ((int) $User->role_id !== 4) {
            abort(404);
        }

        $User->loadMissing([
            'settings',
            'addreses.city',
            'addreses.town',
            'addreses.district',
            'addreses.neighborhood',
            'keywords',
        ]);

        return view('admin_panel.users.user_form', [
            'user' => $User,
            'type' => $this->menuType(),
            'formAction' => route('Users.update', $User),
            'isEdit' => true,
            'userSettings' => $User->settings ?? new UserSetting(),
            'allKeywords' => Keyword::orderBy('name')->get(),
            'selectedKeywords' => $User->keywords->pluck('id')->all(),
            'addresses' => $User->addreses,
        ]);
    }

    public function update(Request $request, User $User)
    {
        if ((int) $User->role_id !== 4) {
            abort(404);
        }

        return $this->upsertUser($request, $User);
    }

    public function destroy(User $User)
    {
        if ((int) $User->role_id !== 4) {
            abort(404);
        }

        $User->delete();

        return redirect()
            ->route('Users.index')
            ->with('success', __('Kullanıcı silindi.'));
    }

    private function upsertUser(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'username' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'phone_number' => ['nullable', 'string', 'max:255'],
            'about' => ['nullable', 'string'],
            'password' => [$user->exists ? 'nullable' : 'required', 'string', 'min:6'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'keywords' => ['nullable', 'array'],
            'keywords.*' => ['integer', 'exists:keywords,id'],
            'settings.receive_messages' => ['nullable', 'boolean'],
            'settings.friendship_allow' => ['nullable', 'boolean'],
            'settings.receive_emails' => ['nullable', 'boolean'],
            'settings.bid_inform' => ['nullable', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        }

        $validated = $validator->validated();

        $user->name = trim($validated['name']);
        $user->email = strtolower(trim($validated['email']));
        $user->username = $validated['username'] ?? null;
        $user->phone_number = $validated['phone_number'] ?? null;
        $user->about = $validated['about'] ?? null;
        $user->role_id = 4;

        if (!$user->exists) {
            $user->email_verified_at = now();
            $user->user_code = $this->generateUserCode();
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $path = public_path('files/users/' . $user->id);
            File::ensureDirectoryExists($path);

            $filename = $user->id . '_' . now()->format('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);

            $user->avatar = $filename;
            $imagePath = $path . '/' . $filename;
            $resizedImage = Image::make($imagePath)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resizedImage->save($path . '/200' . $filename);

            $user->save();
        }

        $settingsData = [
            'receive_messages' => $request->boolean('settings.receive_messages'),
            'friendship_allow' => $request->boolean('settings.friendship_allow'),
            'receive_emails' => $request->boolean('settings.receive_emails'),
            'bid_inform' => $request->boolean('settings.bid_inform'),
        ];

        $user->settings()->updateOrCreate(
            ['user_id' => $user->id],
            $settingsData
        );

        $user->keywords()->sync($validated['keywords'] ?? []);

        $message = $user->wasRecentlyCreated
            ? __('Kullanıcı oluşturuldu.')
            : __('Kullanıcı güncellendi.');

        return response()->json([
            'status' => 'success',
            'message' => $message,
        ]);
    }

    private function generateUserCode(): int
    {
        do {
            $code = random_int(100000, 999999);
            $exists = User::where('user_code', $code)->exists();
        } while ($exists);

        return $code;
    }

    private function menuType(): object
    {
        $type = Type::find(58);

        if ($type) {
            $type->active = 'users';

            return $type;
        }

        return (object) ['active' => 'users'];
    }
}
