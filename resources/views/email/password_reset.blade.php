<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
</head>

<body>
    <div class="flex justify-start mb-6 w-40">
        <img class="w-40" src="{{ asset('icon/logo.svg') }}" alt="Logo">
    </div>
    <p>Ciao,</p>
    <p>La tua password è stata resettata. Ecco la tua nuova password:</p>
    <h3>{{ $password }}</h3>
    <p>Ti preghiamo di cambiarla una volta loggato.</p>
</body>

</html>