<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Task</title>
</head>
<body>
    <h1>Daftar Task</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a href="{{ route('tasks.create') }}">+ Tambah Task</a>

    <table border="1" cellpadding="8" style="margin-top: 16px; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->is_completed ? 'Selesai' : 'Belum Selesai' }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task) }}">Edit</a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus task ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada task.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
