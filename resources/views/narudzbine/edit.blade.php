@extends('layouts.app')

@section('header', 'Izmeni narudžbinu')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Izmeni narudžbinu</h3>
                <a href="{{ url()->previous() }}"
                class="text-sm bg-gray-200 hover:bg-gray-300 text-black font-semibold px-4 py-2 rounded shadow">
                    ⬅ Izlaz
                </a>
            </div>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('narudzbine.update', $narudzbina->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="proizvod_id" class="form-label">Proizvod</label>
                    <select name="proizvod_id" id="proizvod_id" class="form-control" required>
                        @foreach ($proizvodi as $proizvod)
                            <option value="{{ $proizvod->id }}" {{ $narudzbina->proizvod_id == $proizvod->id ? 'selected' : '' }}>
                                {{ $proizvod->naziv }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="kolicina" class="form-label">Količina</label>
                    <input type="number" name="kolicina" id="kolicina" class="form-control" value="{{ $narudzbina->kolicina }}" required>
                </div>

                <div class="mb-4">
                    <label for="adresa" class="form-label">Adresa</label>
                    <textarea name="adresa" id="adresa" rows="4" class="form-control" required>{{ $narudzbina->adresa }}</textarea>
                </div>


                <button type="submit" class="btn btn-warning">Sačuvaj izmene</button>
            </form>
        </div>

    </div>
</div>
@endsection
