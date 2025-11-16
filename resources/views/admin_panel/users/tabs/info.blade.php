<div class="row form-group">
    <div class="col col-md-3">
        <label for="name" class="form-control-label"><b>Adı</b></label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="email" class="form-control-label"><b>E-posta</b></label>
    </div>
    <div class="col-12 col-md-9">
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="username" class="form-control-label"><b>Kullanıcı Adı</b></label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" placeholder="Opsiyonel">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="phone_number" class="form-control-label"><b>Telefon</b></label>
    </div>
    <div class="col-12 col-md-9">
        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $user->phone_number) }}" placeholder="Opsiyonel">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="about" class="form-control-label"><b>Hakkında</b></label>
    </div>
    <div class="col-12 col-md-9">
        <textarea name="about" id="about" rows="3" class="form-control" placeholder="Kullanıcı hakkında not ekleyin">{{ old('about', $user->about) }}</textarea>
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="password" class="form-control-label"><b>Şifre</b></label>
    </div>
    <div class="col-12 col-md-9">
        <input type="password" name="password" id="password" class="form-control" {{ $isEdit ? '' : 'required' }} placeholder="{{ $isEdit ? 'Boş bırakırsanız değişmez' : '' }}">
    </div>
</div>
<div class="row form-group">
    <div class="col col-md-3">
        <label for="avatar" class="form-control-label"><b>Avatar</b></label>
    </div>
    <div class="col-12 col-md-9">
        <input type="file" name="avatar" id="avatar" class="form-control" accept="image/png,image/jpeg">
        <small class="form-text text-muted">jpg, jpeg veya png formatında bir görsel yükleyebilirsiniz.</small>
        @if ($user->avatar)
            <div class="mt-2" id="current-avatar">
                <span class="d-block mb-1">Mevcut Avatar:</span>
                <img src="{{ url('files/users/' . $user->id . '/200' . $user->avatar) }}" alt="Mevcut Avatar" class="img-thumbnail" style="max-height: 200px;">
            </div>
        @endif
    </div>
</div>