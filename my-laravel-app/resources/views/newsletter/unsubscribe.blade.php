<!DOCTYPE html>
<html>
<head>
    <title>Cancellazione dalla Newsletter</title>
</head>
<body>
    <h1>Cancellazione dalla Newsletter</h1>
    <form method="POST" action="{{ route('newsletter.unsubscribe.submit') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Cancellati</button>
    </form>

    @if(session('status'))
        <p>{{ session('status') }}</p>
    @endif

    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</body>
</html>
