<!DOCTYPE html>
<html>
<head>
    <title>Kreiraj narudžbinu</title>
</head>
<body>
    <h1>Kreiraj narudžbinu</h1>

    @if(session('uspeh'))
        <p style="color:green;">{{ session('uspeh') }}</p>
    @endif

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('narudzbine.sacuvaj') }}" method="POST">
        @csrf

        <label for="ime">Ime:</label><br>
        <input type="text" name="ime" value="{{ old('ime') }}"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label for="kolicina">Količina:</label><br>
        <input type="number" name="kolicina" min="1" value="{{ old('kolicina', 1) }}"><br><br>

        <label for="proizvod_id">Proizvod:</label><br>
        <select name="proizvod_id">
            @foreach($proizvodi as $proizvod)
                <option value="{{ $proizvod->id }}">{{ $proizvod->naziv }}</option>
            @endforeach
        </select><br><br>

        <button type="submit">Pošalji</button>
    </form>
</body>
</html>
