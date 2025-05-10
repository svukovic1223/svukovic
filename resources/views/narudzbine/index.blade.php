@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista Narudžbina</h1>
        <a href="{{ route('narudzbine.create') }}" class="btn btn-primary mb-3">Dodaj novu narudžbinu</a>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Proizvod</th>
                    <th>Količina</th>
                    <th>Status</th>
                    <th>Aksiije</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($narudzbine as $narudzbina)
                    <tr>
                        <td>{{ $narudzbina->id }}</td>
                        <td>{{ $narudzbina->proizvod->naziv }}</td>
                        <td>{{ $narudzbina->kolicina }}</td>
                        <td>{{ $narudzbina->status }}</td>
                        <td>
                            <a href="{{ route('narudzbine.edit', $narudzbina->id) }}" class="btn btn-warning">Izmeni</a>
                            <a href="{{ route('narudzbine.delete', $narudzbina->id) }}" class="btn btn-danger">Obriši</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
