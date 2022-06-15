<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Access Forbidden</title>
    <link rel="stylesheet" href="{{ asset('css/restriction_meeting.css') }}">
</head>

<body>
    <div class="base io">
        <h1 class="io">403</h1>
        <h2>Access forbidden</h2>
        <h5>Meeting dapat diakses pada {{ $active_date }}</h5>
    </div>

</body>

</html>