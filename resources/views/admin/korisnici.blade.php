@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-4">Upravljanje korisnicima</h1>

        <div class="mb-3 text-end">
            <a href="{{ route('korisnici.create') }}" class="btn btn-success">Dodaj novog korisnika</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($korisnici as $korisnik)
                    <tr>
                        <td>{{ $korisnik->name }}</td>
                        <td>{{ $korisnik->email }}</td>
                        <td>
                            <a href="{{ route('korisnici.edit', $korisnik->id) }}" class="btn btn-primary btn-sm">Uredi</a>
                            @if(Auth::user() && Auth::user()->role === 'admin')
                                <form action="{{ route('korisnici.obrisi', $korisnik->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Obrisati korisnika?')">Obriši</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
