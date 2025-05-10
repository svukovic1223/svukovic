@extends('nav')

@section('title', 'Početna')

@section('sadrzaj')
@if (session("info"))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>  
@endif

@if (session("success"))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>  
@endif
<h2>Istaknuti proizvodi</h2>
<div class="w3-row-padding w3-padding-16 w3-center">
    @foreach($proizvodi as $proizvod)
        <div class="w3-third w3-margin-bottom">
            <div class="w3-card-4">
                <img src="{{ asset('storage/' . $proizvod->slika) }}" alt="{{ $proizvod->naziv }}" style="width:100%">
                <div class="w3-container">
                    <h5>{{ $proizvod->naziv }}</h5>
                    <p>{{ $proizvod->opis }}</p>
                    <a href="{{ route('proizvod.prikazi', $proizvod->id) }}" class="w3-button w3-black w3-margin-bottom">Opširnije</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
