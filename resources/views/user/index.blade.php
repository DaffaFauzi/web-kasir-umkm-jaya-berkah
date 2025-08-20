@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Data User</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">+ Tambah User</a>

    <table class="table table-bordered">
        <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
    @foreach ($users as $index => $user)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus user ini?')" class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
    </table>
</div>
@endsection