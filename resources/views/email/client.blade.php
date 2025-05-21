<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail Istemi s.r.l</title>
    <style>
        .title {
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="box">
        <p class="title">Gentile {{ $recipient->full_name }}</p>

       {!! $body !!}
    </div>
</body>

</html>
