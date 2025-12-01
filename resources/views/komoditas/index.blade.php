<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komoditas</title>
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
                        <a href="{{ route('komoditas.create') }}" class="btn btn-md btn-success mb-3">Add Komoditas</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">KODE</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col" style="width: 20%">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($komoditas as $k)
                                <tr>
                                    <td>{{ $k->t_komoditas_kode }}</td>
                                    <td>{{ $k->nama }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('komoditas.destroy', $k->id) }}" method="POST">
                                            <a href="{{ route('komoditas.edit', $k->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
                        {{ $komoditas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>