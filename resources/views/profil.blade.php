@extends('layouts.app')

@section('header', 'Moj profil')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Podaci o korisniku</h3>
            <p><strong>Ime:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>Uloga:</strong> {{ Auth::user()->role }}</p>
            <p><strong>Član od:</strong> {{ Auth::user()->created_at->format('d.m.Y') }}</p>
        </div>

        <div class="flex justify-end mb-4">
            <a href="{{ route('narudzbine.create') }}" 
               class="text-black bg-white font-semibold py-2 px-4 rounded shadow">
                + Nova narudžbina
            </a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Moje narudžbine</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($narudzbine as $narudzbina)
                    <div class="border rounded-lg p-4 shadow-sm bg-gray-50 space-y-2">
                        <p><strong>Proizvod:</strong> {{ $narudzbina->proizvod->naziv ?? 'N/A' }}</p>
                        <p><strong>Količina:</strong> {{ $narudzbina->kolicina }}</p>
                        <p><strong>Status:</strong> {{ $narudzbina->status }}</p>
                        <p><strong>Datum:</strong> {{ $narudzbina->created_at->format('d.m.Y') }}</p>

                        <div class="flex space-x-2 mt-3">
                            <a href="{{ route('narudzbine.edit', $narudzbina->id) }}" 
                               class="bg-blue-300 hover:bg-blue-400 text-black focus:outline-none focus:ring-2 focus:ring-blue-400 px-3 py-1 rounded text-sm">
                                Izmeni
                            </a>
                            <form action="{{ route('narudzbine.destroy', $narudzbina->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-300 hover:bg-red-400 text-black px-3 py-1 rounded text-sm">
                                    Obriši
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
