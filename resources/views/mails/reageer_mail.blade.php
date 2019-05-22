<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Een reactie!</h2>

<div>
    Beste {{ $mygender }} {{ $mynaam }} {{ $myachternaam }}, 
    <br>
    Je hebt een reactie terug gekregen.
    <br><br>
    Om te kijken over welk bericht het gaat <a href="{{ URL::to("/posts/") }}/{!! $post_id !!}">klik hier</a>.
    <br>
    <br>
    <h3>Het bericht</h3>
    <u>Geschreven door {{ $gender }} {{ $naam }} {{ $achternaam }}</u>
    <br>
    <br>
    <b>{!! $reactie_titel !!}</b>
    <br>
    {!! $reactie !!}
    <br>
    <br>
    <h3>Reageren</h3>
    Om te reageren op deze reactie <a href="{{ URL::to("/reageer_op/") }}/{!! $hash !!}">klik hier.</a>
    <br>
    Mocht deze link niet werken, kopieer dan deze link in uw webbrowser:
    <br>
    {{ URL::to("/reageer_op/") }}/{!! $hash !!}
    <br>
    <br>
    <hr>
    Automatisch bericht van de weezenhof burenhulp website.<br><br>
    Met vriendelijke groet,<br>
    Weezenhof burenhulp
</div>

</body>
</html>