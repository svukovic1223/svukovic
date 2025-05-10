@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-4">Upravljanje Proizvodima</h1>

        <div class="mb-3 text-end">
            <a href="{{ route('proizvod.create') }}" class="btn btn-success">Dodaj novi proizvod</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Cena</th>
                    <th>Istaknut</th>
                    <th>Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proizvodi as $proizvod)
                    <tr>
                        <td>{{ $proizvod->naziv }}</td>
                        <td>{{ $proizvod->opis }}</td>
                        <td>{{ $proizvod->cena }}</td>
                        <td>
                            @if($proizvod->istaknuto == '1')
                                <span class="badge text-white bg-success">Da</span>
                            @else
                                <span class="badge text-white bg-secondary">Ne</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('proizvod.edit', $proizvod->id) }}" class="btn btn-primary btn-sm">Uredi</a>

                            @if(Auth::user() && Auth::user()->role === 'admin')
                                <form action="{{ route('proizvod.obrisi', $proizvod->id) }}" method="POST" style="display:inline;">
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
