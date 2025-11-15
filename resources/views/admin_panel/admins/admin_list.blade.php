@extends('admin_panel.main_layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ url('/robust-assets/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
@endsection

@section('content')
<div class="row match-height">
    <div class="col-md-12">
        <div class="card" style="min-height: 600px;">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="mb-0">Yöneticiler</h3>
                <a href="{{ route('sudo.admin-create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i> Yeni Yönetici
                </a>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="admins-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Adı</th>
                                    <th>E-posta</th>
                                    <th>Telefon</th>
                                    <th>Admin Kodu</th>
                                    <th>Oluşturulma</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->phone_number ?? '-' }}</td>
                                        <td>{{ $admin->admin_code }}</td>
                                        <td>{{ $admin->created_at?->format('d.m.Y H:i') }}</td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('sudo.admin-edit', $admin) }}" class="btn btn-sm btn-success" title="Düzenle">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('sudo.admin-delete', $admin) }}" method="POST" class="d-inline" onsubmit="return confirmDelete(event, this);">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Sil">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ url('/robust-assets/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script src="{{ url('/robust-assets/js/dataTables.bootstrap5.min.js') }}" type="text/javascript"></script>
<script>
    function confirmDelete(event, form) {
        event.preventDefault();
        Swal.fire({
            title: 'Yönetici silinecek, emin misiniz?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet!',
            cancelButtonText: 'Hayır'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
        return false;
    }

    $(document).ready(function () {
        $('#admins-table').DataTable();
    });
</script>
@endsection