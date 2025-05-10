@extends('layouts.app')

@section('content')
    <h1>Detalji Narudžbine</h1>
    <p><strong>Proizvod:</strong> {{ $narudzbina->proizvod->naziv }}</p>
    <p><strong>Količina:</strong> {{ $narudzbina->kolicina }}</p>
    <p><strong>Status:</strong> {{ $narudzbina->status }}</p>

    @if(Auth::user()->role == 'admin')
        <form action="{{ route('narudzbina.updateStatus', $narudzbina->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="status">Izaberi novi status:</label>
            <select name="status" id="status">
                <option value="u pripremi" {{ $narudzbina->status == 'u pripremi' ? 'selected' : '' }}>U pripremi</option>
                <option value="poslato" {{ $narudzbina->status == 'poslato' ? 'selected' : '' }}>Poslato</option>
                <option value="dostavljeno" {{ $narudzbina->status == 'dostavljeno' ? 'selected' : '' }}>Dostavljeno</option>
            </select>
            <button type="submit">Ažuriraj Status</button>
        </form>
    @endif
@endsection
