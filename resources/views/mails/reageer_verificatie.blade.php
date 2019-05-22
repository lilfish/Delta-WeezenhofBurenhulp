<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Verificatie</h2>

<div>
    Beste <b>{!! $naam !!} {!! $achternaam !!}</b>,
    <br>
    <br>
    Je hebt recentelijk een reactie geplaatst op een bericht op www.weezenhofburenhulp.nl: {{ $titel }}. 
    <br>
    <br>
    <h3>Versturen</h3>
    Om deze reactie te versturen  <a href=<a href={{ URL::to("/verificatie/r/") }}/{!! $hash !!}>klik hier</a>.    <br>
    <br>
    Mocht deze link niet werken, kopieer dan deze link in uw webbrowser:
    <br>
    {{ URL::to("/verificatie/r/") }}/{!! $hash !!}
    <br>
    <br>
    <h3>Verwijderen</h3>
    Wil je deze post verwijderen, <a href={{ URL::to("/verwijder_bericht/") }}/{!! $delete_hash !!}>klik hier</a>.
    <br>
    Mocht deze link niet werken, kopieer dan deze link in uw webbrowser:
    <br>
    {{ URL::to("/verwijder_bericht/") }}/{!! $delete_hash !!}
    <br>
    <br>
    <hr>
    Automatisch bericht van de weezenhof burenhulp website.<br><br>
    Met vriendelijke groet,<br>
    Weezenhof burenhulp

   
</div>

</body>
</html>