<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Buku</title>
    <!-- Tambahkan link stylesheet Bootstrap di sini -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h4 class="mb-4">UPDATE BUKU</h4>
    <form method="post" action="{{ route('buku.update', $buku->id) }}">
        @csrf
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}" required>
        </div>
        <div class="mb-3">
            <label for="tgl_terbit" class="form-label">Tgl. Terbit</label>
            <input type="text" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit }}" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">UPDATE</button>
            <a href="/buku" class="btn btn-secondary">BATAL</a>
        </div>
    </form>
</div>


</body>
</html>
