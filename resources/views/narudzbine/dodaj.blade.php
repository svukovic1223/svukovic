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

        <form action="{{ route('narudzbine.dodato') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="ime" class="form-lable">Ime</label>
                    <input type="text" name="ime" id="ime" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="adresa" class="form-label">Adresa</label>
                    <textarea name="adresa" id="adresa" rows="2" class="form-control" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="proizvod_id" class="form-label">Proizvod</label>
                    <select name="proizvod_id" id="proizvod_id" class="form-control" required>
                        @foreach ($proizvodi as $proizvod)
                            <option value="{{ $proizvod->id }}">{{ $proizvod->naziv }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kolicina" class="form-label">Količina</label>
                    <input type="number" name="kolicina" id="kolicina" min="1" class="form-control" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Dodaj Narudzbinu</button>
                </div>
            </form>
    </div>
@endsection
