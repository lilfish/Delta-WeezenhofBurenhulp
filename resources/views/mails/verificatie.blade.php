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
    Je hebt recentelijk het bricht "{{ $post_titel }}" geplaatst op www.weezenhofburenhulp.nl.
    <br>
    <br>
    <h3>Online zetten</h3>
    Om dit bericht online te zetten <a href={{ URL::to("/verificatie/p/") }}/{!! $hash !!}>klik hier</a>.
    <br>
    Mocht deze link niet werken, kopieer dan deze link in uw webbrowser:
    <br>
    {{ URL::to("/verificatie/p/") }}/{!! $hash !!}
    <br>
    <br>
    <h3>Afhandellen</h3>
    Wil je dit bericht als afgehandeld markeren, <a href={{ URL::to("/post_afhandelen/") }}/{!! $afhandel_hash !!}>klik hier</a>.
    <br>
    Mocht deze link niet werken, kopieer dan deze link in uw webbrowser:
    <br>
    {{ URL::to("/post_afhandelen/") }}/{!! $afhandel_hash !!}
    <br>
    <br>
    <h3>Verwijderen</h3>
    Wil je dit bericht verwijderen, <a href={{ URL::to("/verwijder_post/") }}/{!! $delete_hash !!}>klik hier</a>.
    <br>
    Mocht deze link niet werken, kopieer dan deze link in uw webbrowser:
    <br>
    {{ URL::to("/verwijder_post/") }}/{!! $delete_hash !!}
    <br>
    <br>
    <hr>
    Automatisch bericht van de weezenhof burenhulp website.<br><br>
    Met vriendelijke groet,<br>
    Weezenhof burenhulp

   
</div>

</body>
</html>