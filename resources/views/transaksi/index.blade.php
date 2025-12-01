<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                <span class="text-success mt-2">
                    {{ session('success') }}
                </span>
                @elseif(session('error'))
                <span class="text-danger mt-2">
                    {{ session('error') }}
                </span>
                @endif
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('transaksi.create') }}" class="btn btn-md btn-success mb-3">Add Transaksi</a>


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Komoditas</th>
                                    <th>Produksi (Rp)</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($transaksi as $t)
                                <tr>
                                    <td>{{ $t->tanggal_type }}</td>
                                    <td>{{ $t->komoditas->t_komoditas_nama }}</td>
                                    <td>{{ number_format($t->produksi) }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.destroy', $t->id) }}" method="POST">
                                            <a href="{{ route('transaksi.edit', $t->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Komoditas</th>
                                    <th>January</th>
                                    <th>February</th>
                                    <th>March</th>
                                    <th>April</th>
                                    <th>May</th>
                                    <th>June</th>
                                    <th>July</th>
                                    <th>August</th>
                                    <th>September</th>
                                    <th>October</th>
                                    <th>November</th>
                                    <th>December</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($report as $r)
                                <tr>
                                    <td>{{ $r['tahun'] }}</td>
                                    <td>{{ $r['komoditas'] }}</td>
                                    <td>{{ number_format($r['january']) }}</td>
                                    <td>{{ number_format($r['february']) }}</td>
                                    <td>{{ number_format($r['march']) }}</td>
                                    <td>{{ number_format($r['april']) }}</td>
                                    <td>{{ number_format($r['may']) }}</td>
                                    <td>{{ number_format($r['june']) }}</td>
                                    <td>{{ number_format($r['july']) }}</td>
                                    <td>{{ number_format($r['august']) }}</td>
                                    <td>{{ number_format($r['september']) }}</td>
                                    <td>{{ number_format($r['october']) }}</td>
                                    <td>{{ number_format($r['november']) }}</td>
                                    <td>{{ number_format($r['december']) }}</td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>