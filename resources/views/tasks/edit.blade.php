<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Judul</label><br>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" required>
        </div>
        <div>
            <label>Deskripsi</label><br>
            <textarea name="description">{{ old('description', $task->description) }}</textarea>
        </div>
        <div>
            <label>
                <input type="checkbox" name="is_completed" value="1" {{ $task->is_completed ? 'checked' : '' }}>
                Selesai
            </label>
        </div>
        <button type="submit">Perbarui</button>
    </form>

    <a href="{{ route('tasks.index') }}">Kembali</a>
</body>
</html>
