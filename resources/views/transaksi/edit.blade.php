<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form method="POST" action="{{ route('transaksi.update', $data->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">TANGGAl</label>
                                <input type="date" class="form-control @error('tanggal_type') is-invalid @enderror" name="tanggal_type" value="{{ old('tanggal_type', $data->tanggal_type) }}">

                                @error('tanggal_type')
                                <span class="text-danger mt-2">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">KOMODITAS</label>
                                <select name="t_komoditas_kode" class="form-control @error('t_komoditas_kode') is-invalid @enderror">
                                    @foreach($komoditas as $k)
                                    <option value="{{ $k->t_komoditas_kode }}" {{ $k->t_komoditas_kode == $data->t_komoditas_kode ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                    @endforeach
                                </select>

                                @error('t_komoditas_kode')
                                <span class="text-danger mt-2">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">PRODUKSI</label>
                                <input type="number" class="form-control @error('produksi') is-invalid @enderror" name="produksi" value="{{ old('produksi', $data->produksi) }}">

                                @error('produksi')
                                <span class="text-danger mt-2">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>