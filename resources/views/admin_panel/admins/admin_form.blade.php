@extends('admin_panel.main_layout')

@section('content')
<div class="row match-height">
    <div class="col-md-12">
        <div class="card" style="min-height: 600px;">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0">
                    {{ $isEdit ? 'Yönetici Güncelle' : 'Yeni Yönetici Oluştur' }}
                </h3>
                <a href="{{ route('sudo.admin-list') }}" class="btn btn-secondary">Geri Dön</a>
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

                        <input type="hidden" name="id" value="{{ old('id', $admin->id) }}">

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="name" class="form-control-label"><b>Adı</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="email" class="form-control-label"><b>E-posta</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="phone_number" class="form-control-label"><b>Telefon</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', $admin->phone_number) }}" placeholder="Opsiyonel">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="password" class="form-control-label"><b>Şifre</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="password" id="password" class="form-control" {{ $isEdit ? '' : 'required' }} placeholder="{{ $isEdit ? 'Boş bırakırsanız mevcut şifre korunur' : 'En az 6 karakter' }}">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection