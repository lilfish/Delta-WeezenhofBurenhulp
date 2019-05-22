<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Contact mail</h2>

<div>
    Contact bericht van weezenhof.
    <br>
    <br>
    <h3>Het bericht</h3>
    Geschreven door {{ $gender }} {{ $naam }} {{ $achternaam }}
    <br>
    <br>
    {!! $bericht !!}
    <br>
    <br>
    <h3>Email</h3>
    {{ $email }}
    <br>
    <br>
    <hr>
    Automatisch bericht van de weezenhof burenhulp website.<br><br>
    Met vriendelijke groet,<br>
    Weezenhof burenhulp
</div>

</body>
</html>