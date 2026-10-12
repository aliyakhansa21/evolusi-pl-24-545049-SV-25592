<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Task</title>
</head>
<body>
    <h1>Tambah Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div>
            <label>Judul</label><br>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>
        <div>
            <label>Deskripsi</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>
        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('tasks.index') }}">Kembali</a>
</body>
</html>
