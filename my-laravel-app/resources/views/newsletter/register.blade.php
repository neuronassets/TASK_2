<!DOCTYPE html>
<html>
<head>
    <title>Registrazione alla Newsletter</title>
</head>
<body>
    <h1>Registrazione alla Newsletter</h1>
    <form method="POST" action="{{ route('newsletter.register.submit') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Registrati</button>
    </form>

    @if(session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</body>
</html>
