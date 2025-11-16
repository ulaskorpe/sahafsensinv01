@extends('admin_panel.main_layout')

@section('content')
<div class="row match-height">
    <div class="col-md-12">
        <div class="card" style="min-height: 650px;">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0">{{ $isEdit ? 'Kullanıcı Güncelle' : 'Yeni Kullanıcı Oluştur' }}</h3>
                <a href="{{ route('Users.index') }}" class="btn btn-secondary">Geri Dön</a>
            </div>
            <div class="card-body collapse in">
                <div class="card-block" style="padding-left: 30px;padding-right: 30px;">
                    <form id="user-form" action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif
                        <input type="hidden" name="role_id" value="4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" aria-controls="info" role="tab" aria-selected="true">Bilgiler</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" aria-controls="settings" role="tab" aria-selected="false">Ayarlar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" aria-controls="addresses" role="tab" aria-selected="false">Adresler</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="keywords-tab" data-toggle="tab" href="#keywords" aria-controls="keywords" role="tab" aria-selected="false">Anahtar Kelimeler</a>
                            </li>
                        </ul>
                        <div class="tab-content" style="padding: 20px 10px;">
                            <div class="tab-pane active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                @include('admin_panel.users.tabs.info')
                            </div>
                            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                @include('admin_panel.users.tabs.settings')
                            </div>
                            <div class="tab-pane" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
                                @include('admin_panel.users.tabs.addresses')
                            </div>
                            <div class="tab-pane" id="keywords" role="tabpanel" aria-labelledby="keywords-tab">
                                @include('admin_panel.users.tabs.keywords')
                            </div>
                        </div>
                        <div class="form-actions right" style="padding-top: 10px;">
                            <button type="button" class="btn btn-primary" onclick="userFormSubmit()">
                                <i class="icon-check2"></i> Kaydet
                            </button>
                            <a href="{{ route('Users.index') }}" class="btn btn-secondary">Vazgeç</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ url('assets/js/sweetalert2@11.js') }}" type="text/javascript"></script>
<script src="{{ url('assets/js/saveV3.js') }}" type="text/javascript"></script>
<script>
    function userFormSubmit() {
        const formData = new FormData(document.getElementById('user-form'));
        save(formData, '{{ $formAction }}', '', '', '{{ route('Users.index') }}');
        return false;
    }
</script>
@endsection