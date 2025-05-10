@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-4">Upravljanje Narudzbinama</h1>

        <div class="mb-3 text-end">
            <a href="{{ route('narudzbine.dodaj') }}" class="btn btn-success">Dodaj novu narudzbine</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ime</th>
                    <th>Email</th>
                    <th>Proizvod</th>
                    <th>Adresa</th>
                    <th>Status</th>
                    <th>Korisnik</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach($narudzbina as $narudzbine)
                    <tr>
                        <td>{{ $narudzbine->ime }}</td>
                        <td>{{ $narudzbine->email }}</td>
                        <td>{{ $narudzbine->proizvod_id }}</td>
                        <td>{{ $narudzbine->adresa }}</td>
                        <td>{{ $narudzbine->status }}</td>
                        <td>{{ $narudzbine->user_id }}</td>
                        <td>
                            <a href="{{ route('narudzbine.izmeni', $narudzbine->id) }}" class="btn btn-primary btn-sm">Uredi</a>

                            @if(Auth::user() && Auth::user()->role === 'admin')
                                <form action="{{ route('narudzbine.obrisi', $narudzbine->id) }}" method="POST" style="display:inline;">
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
