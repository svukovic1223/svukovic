@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Izmeni korisnika</h2>
    <form action="{{ route('korisnici.update', $korisnik->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Ime</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $korisnik->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email adresa</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $korisnik->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nova lozinka (opcionalno)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
    </form>
</div>
@endsection
