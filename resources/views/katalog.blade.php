@extends('layout')

@section('title', 'Katalog')

@section('sadrzaj')
<h2 class="w3-xlarge w3-text-dark-grey w3-padding-16">Katalog proizvoda</h2>

<div class="w3-row-padding">
    @foreach($proizvodi as $proizvod)
    <div class="w3-quarter w3-margin-bottom">
        <div class="w3-card-4">
            <img src="{{ asset('storage/' . $proizvod->slika) }}" alt="{{ $proizvod->naziv }}" style="width:100%; height:50%; object-fit:cover">
            <div class="w3-container" style="padding:10px">
                <h5 style="margin:5px 0">{{ $proizvod->naziv }}</h5>
                <p class="w3-small w3-opacity" style="margin:5px 0">Cena: {{ $proizvod->cena }} RSD</p>
                <a href="{{ route('proizvod.prikazi', $proizvod->id) }}" class="w3-button w3-dark-grey w3-small w3-block">Opširnije</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
