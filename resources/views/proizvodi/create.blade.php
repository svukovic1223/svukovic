@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="my-4">Dodaj Novi Proizvod</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('proizvod.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label for="naziv" class="form-label">Naziv</label>
                <input type="text" name="naziv" id="naziv" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="opis" class="form-label">Opis</label>
                <textarea name="opis" id="opis" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="cena" class="form-label">Cena</label>
                <input type="number" step="0.01" name="cena" id="cena" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="istaknuto" id="istaknuto" class="form-check-input" value="1">
                <label class="form-check-label" for="istaknuto">Istakni proizvod</label>
            </div>

            <div class="mb-3">
                <label for="kategorija_id" class="form-label">Kategorija</label>
                <select name="kategorija_id" id="kategorija_id" class="form-select" required>
                    <option value="" disabled selected>-- Izaberi kategoriju --</option>
                    @foreach ($kategorije as $kategorija)
                        <option value="{{ $kategorija->id }}">{{ $kategorija->naziv }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="slika" class="form-label">Slika proizvoda</label>
                <input type="file" name="slika" id="slika" class="form-control" accept="image/*" required>
            </div>


            <button type="submit" class="btn btn-success">Dodaj Proizvod</button>
        </form>
    </div>
@endsection
