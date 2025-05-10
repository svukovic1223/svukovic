@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Izmeni narudžbinu</h2>

    <form method="POST" action="{{ route('narudzbina.azuriraj', $narudzbina->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ime" class="form-label">Ime</label>
            <input type="text" name="ime" id="ime" class="form-control" value="{{ old('ime', $narudzbina->ime) }}" required>
        </div>

        <div class="mb-3">
            <label for="adresa" class="form-label">Adresa</label>
            <textarea name="adresa" id="adresa" rows="2" class="form-control" required>{{ old('adresa', $narudzbina->adresa) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="proizvod_id" class="form-label">Proizvod</label>
            <select name="proizvod_id" id="proizvod_id" class="form-select" required>
                @foreach ($proizvodi as $proizvod)
                    <option value="{{ $proizvod->id }}" {{ $narudzbina->proizvod_id == $proizvod->id ? 'selected' : '' }}>
                        {{ $proizvod->naziv }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kolicina" class="form-label">Količina</label>
            <input type="number" name="kolicina" id="kolicina" min="1" class="form-control" value="{{ old('kolicina', $narudzbina->kolicina) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
    </form>
</div>
@endsection
