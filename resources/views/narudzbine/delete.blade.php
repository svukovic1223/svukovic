@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Brisanje narudžbine</h1>
        <p>Da li ste sigurni da želite da obrišete ovu narudžbinu?</p>

        <form action="{{ route('narudzbine.destroy', $narudzbina->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <p>Proizvod: {{ $narudzbina->proizvod->naziv }}</p>
            <p>Količina: {{ $narudzbina->kolicina }}</p>
            <p>Status: {{ $narudzbina->status }}</p>

            <button type="submit" class="btn btn-danger">Obriši</button>
            <a href="{{ route('narudzbine.index') }}" class="btn btn-secondary">Otkaži</a>
        </form>
    </div>
@endsection
