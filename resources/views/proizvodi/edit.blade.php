@extends('layouts.admin')

@section('title', 'Izmena proizvoda')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Izmeni proizvod</h2>

    <form method="POST" action="{{ route('proizvodi.update', $proizvod->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="naziv" class="form-label">Naziv</label>
            <input type="text" name="naziv" id="naziv" class="form-control" value="{{ old('naziv', $proizvod->naziv) }}">
        </div>

        <div class="mb-3">
            <label for="opis" class="form-label">Opis</label>
            <textarea name="opis" id="opis" class="form-control" rows="4">{{ old('opis', $proizvod->opis) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cena" class="form-label">Cena</label>
            <input type="number" step="0.01" name="cena" id="cena" class="form-control" value="{{ old('cena', $proizvod->cena) }}">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="istaknuto" id="istaknuto" class="form-check-input" value="1">
            <label class="form-check-label" for="istaknuto">Istakni proizvod</label>
        </div>

        <div class="mb-3">
            <label for="slika" class="form-label">Nova slika</label>
            <input type="file" name="slika" id="slika" class="form-control">
        </div>

        <div class="mb-3">
            <label for="kategorija_id" class="form-label">Kategorija</label>
            <select name="kategorija_id" id="kategorija_id" class="form-select">
                @foreach ($kategorije as $kategorija)
                    <option value="{{ $kategorija->id }}" {{ $proizvod->kategorija_id == $kategorija->id ? 'selected' : '' }}>
                        {{ $kategorija->naziv }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
    </form>
</div>
@endsection
