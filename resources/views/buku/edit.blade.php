<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <h1 class="mb-4">Edit Book</h1>
        <form action="{{ route('buku.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ $book->judul }}" required>
            </div>

            <div class="mb-3">
                <label for="pengarang" class="form-label">Pengarang</label>
                <input type="text" name="pengarang" id="pengarang" class="form-control" value="{{ $book->pengarang }}" required>
            </div>

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" name="tahun" id="tahun" class="form-control" value="{{ $book->tahun }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Book</button>
            <a href="{{ route('bukus.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
