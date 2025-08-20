@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah User</h1>

    <form action="{{ route('user.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Email/Username</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
</div>
@endsection