@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Dodaj korisnika</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('korisnici.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Ime</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email adresa</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Lozinka</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj</button>
    </form>
</div>
@endsection
