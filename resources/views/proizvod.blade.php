@extends('layout')

@section('title', $proizvod->naziv)

@section('sadrzaj')

<div class="w3-card-4 w3-white w3-padding-16 w3-margin-bottom" style="max-width:800px; margin:auto">
    <h2 class="w3-center w3-text-dark-grey">{{ $proizvod->naziv }}</h2>

    <div class="w3-center w3-padding">
        <img src="{{ asset('storage/' . $proizvod->slika) }}" alt="{{ $proizvod->naziv }}" class="w3-image w3-round-large" style="max-width:100%; height:auto; max-height:400px; object-fit:cover">
    </div>

    <div class="w3-container w3-padding">
        <p class="w3-large">{{ $proizvod->opis }}</p>
        <p class="w3-xlarge"><strong>Cena:</strong> {{ $proizvod->cena }} RSD</p>

        <a href="{{ route('katalog') }}" class="w3-button w3-dark-grey w3-round-large">← Nazad na katalog</a>
    </div>
</div>

@endsection
