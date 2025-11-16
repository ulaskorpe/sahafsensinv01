@if($addresses->isEmpty())
    <div class="alert alert-info" role="alert">Kayıtlı adres bulunamadı.</div>
@else
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Tip</th>
                    <th>Adres</th>
                    <th>İl</th>
                    <th>İlçe</th>
                    <th>Mahalle</th>
                    <th>Varsayılan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                    <tr>
                        <td>{{ $address->name ?? '-' }}</td>
                        <td>{{ $address->type ?? '-' }}</td>
                        <td>{{ $address->address ?? '-' }}</td>
                        <td>{{ $address->city->name ?? '-' }}</td>
                        <td>{{ $address->town->name ?? $address->district->name ?? '-' }}</td>
                        <td>{{ $address->neighborhood->name ?? '-' }}</td>
                        <td>{{ $address->selected ? 'Evet' : 'Hayır' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif