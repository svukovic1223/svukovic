@extends('layouts.app')

@section('header', 'Izmena profila')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <div class="bg-white p-6 rounded-lg shadow mb-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Izmeni podatke profila</h3>
                <a href="{{ url()->previous() }}"
                   class="text-sm bg-gray-200 hover:bg-gray-300 text-black font-semibold px-4 py-2 rounded shadow">
                    ⬅ Izlaz
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block font-medium">Ime</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200" required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-medium">Email adresa</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full mt-1 border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="text-right">
                    <button type="submit" class="bg-black text-black px-4 py-2 rounded shadow">
                        Sačuvaj izmene
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
