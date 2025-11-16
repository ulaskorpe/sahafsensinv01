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

                    <form action="{{ $formAction }}" method="POST" id="admin-form" enctype="multipart/form-data">
                      
                        @csrf

                        <input type="hidden" name="id" value="{{ old('id', $admin->id) }}">

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="name" class="form-control-label"><b>Adı</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="email" class="form-control-label"><b>E-posta</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $admin->email) }}">
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
                                <label for="avatar" class="form-control-label"><b>Avatar</b></label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" name="avatar" id="avatar" class="form-control" accept="image/png,image/jpeg">
                                <small class="form-text text-muted">jpg, jpeg veya png formatında bir görsel yükleyebilirsiniz.</small>
                                <div class="mt-2" id="avatar-preview" style="display: none;">
                                    <img src="#" alt="Avatar Önizleme" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                                @if ($admin->avatar)
                                    <div class="mt-2" id="current-avatar">
                                        <span class="d-block mb-1">Mevcut Avatar:</span>
                                        <img src="{{ url('files/users/' . $admin->id . '/200' . $admin->avatar) }}" alt="Mevcut Avatar" class="img-thumbnail" style="max-height: 200px;">
                                    </div>
                                @endif
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

@section('scripts')
<script src="../../../assets/js/sweetalert2@11.js" type="text/javascript"></script>
<script src="../../../assets/js/saveV3.js" type="text/javascript"></script>
<script>
    const avatarInput = document.getElementById('avatar');
    const avatarPreviewContainer = document.getElementById('avatar-preview');
    const avatarPreviewImage = avatarPreviewContainer ? avatarPreviewContainer.querySelector('img') : null;
    const currentAvatar = document.getElementById('current-avatar');

    if (avatarInput) {
        avatarInput.addEventListener('change', function (event) {
            if (!avatarPreviewContainer || !avatarPreviewImage) {
                return;
            }

            const file = event.target.files[0];

            if (!file) {
                avatarPreviewContainer.style.display = 'none';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                avatarPreviewImage.src = e.target.result;
                avatarPreviewContainer.style.display = 'block';

                if (currentAvatar) {
                    currentAvatar.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        });
    }

    async function adminFormSubmit() {
        $('#name').removeClass('border-danger');
        $('#email').removeClass('border-danger');
        $('#password').removeClass('border-danger');

        const name = $('#name').val().trim();
        const email = $('#email').val().trim();
        const password = $('#password').val();

        if (name === '') {
            $('#name').focus();
            $('#name').addClass('border-danger');
            Swal.fire({
                icon: 'error',
                text: 'Adı alanı zorunludur.'
            });

            return false;
        }

        if (email === '') {
            $('#email').focus();
            $('#email').addClass('border-danger');
            Swal.fire({
                icon: 'error',
                text: 'E-posta alanı zorunludur.'
            });

            return false;
        }

        try {
            const response = await fetch('/admin-panel/check-email/' + encodeURIComponent(email));
            const data = await response.json();

            if (data !== 'ok') {
                $('#email').val('');
                $('#email').focus();
                $('#email').addClass('border-danger');
                Swal.fire({
                    icon: 'error',
                    text: data
                });

                return false;
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                text: 'E-posta doğrulaması yapılırken bir hata oluştu.'
            });

            return false;
        }

        if (password !== '' && password.length < 6) {
            $('#password').focus();
            $('#password').addClass('border-danger');
            Swal.fire({
                icon: 'error',
                text: 'Şifre en az 6 karakter olmalıdır.'
            });

            return false;
        }

        const formData = new FormData(document.getElementById('admin-form'));

        save(formData, '{{ $formAction }}', '', '', '{{ route('sudo.admin-list') }}');

        return false;
    }
</script>

@endsection