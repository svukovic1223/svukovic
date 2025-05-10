@extends('layouts.app')

@section('header', 'Dodaj novu narudžbinu')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Dodaj narudžbinu</h3>
                <a href="{{ url()->previous() }}"
                class="text-sm bg-gray-200 hover:bg-gray-300 text-black font-semibold px-4 py-2 rounded shadow">
                    ⬅ Izlaz
                </a>
            </div>


            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('narudzbine.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="ime" class="block text-sm font-medium text-gray-700">Ime</label>
                    <input type="text" name="ime" id="ime" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div>
                    <label for="adresa" class="block text-sm font-medium text-gray-700">Adresa</label>
                    <textarea name="adresa" id="adresa" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                </div>

                <div>
                    <label for="proizvod_id" class="block text-sm font-medium text-gray-700">Proizvod</label>
                    <select name="proizvod_id" id="proizvod_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        @foreach ($proizvodi as $proizvod)
                            <option value="{{ $proizvod->id }}">{{ $proizvod->naziv }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="kolicina" class="block text-sm font-medium text-gray-700">Količina</label>
                    <input type="number" name="kolicina" id="kolicina" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-black font-semibold py-2 px-4 rounded">
                        Sačuvaj
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
