<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <title>Login</title>
</head>

<body>
    <div class="login-box">
        <div class="login-header">
            <header>Login</header>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-box">
                <input type="text" name="email" class="input-field" placeholder="Email" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Password" autocomplete="off" required>
            </div>
            <br>
            <div class="input-submit">
                <button type="submit" class="submit-btn" id="submit"></button>
                <label for="submit">Sign In</label>
            </div>
            @if ($errors->any())
            <div class="error-message text-red-500 text-center mt-2">
                {{ $errors->first() }}
            </div>
            @endif
        </form>
    </div>
</body>

</html>