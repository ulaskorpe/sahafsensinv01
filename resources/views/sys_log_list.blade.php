<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>list</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="p-4">

<div class="container">
    <h3 class="mb-4">System Logs</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Type</th>
            <th>Data</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item['id'] }}</td>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['type'] }}</td>
            <td>
                @php
                    $jsonData =$item['data']; //json_encode($item['data'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    $modalId = 'jsonDataModal-' . $item['id'];
                @endphp

                <!-- Buton -->
                <button class="btn btn-sm btn-info" type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#{{ $modalId }}">
                    Göster
                </button>

                <!-- Modal -->
                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="{{ $modalId }}Label">Telefon JSON Verisi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                            </div>
                            <div class="modal-body">
                                <pre class="bg-light p-3 border rounded small" style="max-height: 500px; overflow:auto;">
            {{ $jsonData }}
                                </pre>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>{{ \Carbon\Carbon::parse($item['created_at'])->format('d.m.Y H:i') }}</td>
            <td>
                <button class="btn btn-danger btn-sm delete-btn"
                        data-id="{{ $item['id'] }}">
                    Delete
                </button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 $(function () {
    // Göster butonuna tıklayınca modal aç
    $('.showLogBtn').on('click', function () {
        let message = $(this).data('message'); // data-message içeriğini al
        $('#logModalBody').text(message);      // modal body içine koy
        $('#logModal').modal('show');
    });

    // Sil butonuna tıklayınca swal ile confirm
    $('.delete-btn').on('click', function () {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Emin misiniz?',
            text: "Bu log silinecek!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Evet, sil',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/delete-log/' + id;
            }
        });
    });
});
</script>

</body>
</html>
