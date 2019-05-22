@extends('home')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/bulma-accordion.min.js') }}"></script>
<link rel="stylesheet" href={{ asset('css/bulma-accordion.min.css') }}>

@section('content')
<div class="is-size-3 m-b-xl" id="nieuwe_categorie">Nieuwe categorie aanmaken: </div>
@if(session()->has('aanmaak_message'))
    <div class="notification is-info animated">
        <button class="delete"></button>
        <ul>
            <li>{{ session()->get('aanmaak_message') }}</li>
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                $notification = $delete.parentNode;
                $delete.addEventListener('click', () => {
                $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
@endif
<form method="POST" action="newCategorie">
    @csrf
    <div class="field">
        <div class="label">Naam:</div>
        <div class="control">
            <input name="categorie_Naam" type="text" class="input"></input>
        </div>
    </div>
    <div class="field">
        <div class="label">Omschrijving:</div>
        <div class="control">
            <textarea id="editor2" name="categorie_KleineOmschrijving" class="textarea"> </textarea>
        </div>
    </div>
    <div class="field">
        <div class="label">Extra informatie:</div>
        <div class="control">
            <textarea id="editor1" name="categorie_GroteOmschrijving" class="textarea"> </textarea>
        </div>
    </div>
    <br>
    <input type="submit" class="button is-primary is-large" value="Aanmaken">
</form>
<script>
    $('.textarea').each(function (e) {
        CKEDITOR.replace(this.id, {});
    });
</script>

<br>
<hr>
<br>

<div class="is-size-3" id="delete_categorie">Categorie verwijderen: </div>
@if(session()->has('del_message'))
    <div class="notification is-info animated">
        <button class="delete"></button>
        <ul>
            <li>{{ session()->get('del_message') }}</li>
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                $notification = $delete.parentNode;
                $delete.addEventListener('click', () => {
                $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
@endif
<p>Let op! Dit zorgt er voor dat ook alle posts in die categorie!</p>
<br>
<form method="POST" action="deleteCategorie">
    @csrf
    <table class="table is-fullwidth">
        <thead>
            <tr>
                <th><abbr title="catName">Categorie name</abbr></th>
                <th><abbr title="Delete">Verwijder</abbr></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allCategories as $categorie)
            <tr>
                <td>{{ $categorie->titel }}</td>
                <td><input value="{{ $categorie->titel }}" name="categorieDeleten" class="radio" type="radio"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <input type="submit" class="button is-primary is-large" value="Verwijder">
</form>
<br>
<hr>
<div class="is-size-3" id="update_categorie">Categorie aanpassen: </div>
@if(session()->has('update_message'))
    <div class="notification is-info animated">
        <button class="delete"></button>
        <ul>
            <li>{{ session()->get('update_message') }}</li>
        </ul>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                $notification = $delete.parentNode;
                $delete.addEventListener('click', () => {
                $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
@endif
<br>
<section class="accordions">
    @foreach ($allCategories as $categorie)
    <article class="accordion is-info">
        <div class="accordion-header">
            {{ $categorie->titel }}
            <button class="toggle" aria-label="toggle"></button>
        </div>
        <div class="accordion-body">
            <form method="POST" action="updateCategorie">
                @csrf
            <div class="accordion-content">
                <div class="field">
                    <div class="label">Naam:</div>
                    <div class="control">
                        <input name="categorie_Naam" value="{{ $categorie->titel }}" type="text" class="input">
                    </div>
                </div>
                <div class="field">
                    <div class="label">Omschrijving:</div>
                    <div class="control">
                        <textarea id="editor22{{ $categorie->id }}" name="categorie_KleineOmschrijving" class="textarea2">{{ $categorie->omschrijving }}</textarea>
                    </div>
                </div>
                <div class="field">
                    <div class="label">Extra informatie:</div>
                    <div class="control">
                        <textarea id="editor11{{ $categorie->id }}" name="categorie_GroteOmschrijving" class="textarea2">{{ $categorie->informatie }}</textarea>
                    </div>
                </div>
                <input type="hidden" name="cat_id" value="{{ $categorie->id }}">
                <input type="submit" class="button is-primary is-large" value="Updaten">
            </div>
            </form>
        </div>
    </article>
    @endforeach
</section>
<script>
    var accordions = bulmaAccordion.attach();
    $('.textarea2').each(function (e) {
        CKEDITOR.replace(this.id, {});
    });
</script>
<br>
@stop