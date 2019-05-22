@include('layout.layout_header')
<section class="main-content columns is-fullheight">
    <aside class="column is-2 is-narrow-mobile is-fullheight section">
        <p class="menu-label ">Navigatie</p>
        <ul class="menu-list">
            <li>
                <a href="{{ URL::to('/home') }}" class="">Dashboard</a>
            </li>
            @if (Auth::user()->level >= 3)
            <li>
                <a href="{{ URL::to('/home/moderator') }}" class="">Moderators</a>
                <ul>
                    <li>
                        <a href="{{ URL::to('/home/moderator#nieuwe_moderator') }}" class="has-text-primary is-italic is-size-7">Moderator toevoegen</a>
                    </li>
                </ul>
            </li>
            <li>
            <a href="{{ URL::to('/home/categorie') }}" class="">Categorieen</a>
            <ul>
                <li>
                    <a href="{{ URL::to('/home/categorie#nieuwe_categorie') }}" class="has-text-primary is-italic is-size-7">Nieuwe categorie</a>
                </li>
                <li>
                    <a href="{{ URL::to('/home/categorie#nieuwe_categorie') }}" class="has-text-primary is-italic is-size-7">Verwijder categorie</a>
                </li>
                <li>
                    <a href="{{ URL::to('/home/categorie#update_categorie') }}" class="has-text-primary is-italic is-size-7">Update categorie</a>
                </li>
            </ul>
            </li>

            <li>
                <a href="{{ URL::to('/home/edithome') }}" class="">Homepage</a>
                <ul>
                    <li>
                        <a href="{{ URL::to('/home/edithome#nieuwe_afbeelding') }}" class="has-text-primary is-italic is-size-7">Nieuwe afbeelding</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/home/edithome#delete_afbeelding') }}" class="has-text-primary is-italic is-size-7">Verwijder afbeelding</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/home/edithome#update_tekst') }}" class="has-text-primary is-italic is-size-7">Update welkom tekst</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ URL::to('/home/contact') }}" class="">Contact gegevens</a>
            </li>
            <li>
                <a href="{{ URL::to('/home/help') }}" class="">Help pagina aanpassen</a>
            </li>
            <li>
                <a href="{{ URL::to('/home/agreement') }}" class="">Algemene voorwaarden aanpassen</a>
            </li>
            <li>
                <a href="{{ URL::to('/home/mail') }}" class="">Mails</a>
                <ul>
                    <li>
                        <a href="{{ URL::to('/home/mail#aantal') }}" class="has-text-primary is-italic is-size-7">Aantal mails verzonden</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/home/mail#alle_mail') }}" class="has-text-primary is-italic is-size-7">Alle reageer mails</a>
                    </li>
                </ul>
            </li>
            @endif
            @if (Auth::user()->level >= 2)
            <li>
                <a href="{{ URL::to('/home/posts') }}" class="">Alle posts</a>
            </li>
            <li>
                <a href="{{ URL::to('/home/gebruikers') }}" class="">Gebruikers</a>
            </li>
            @endif
            <li>
                <a href="{{ URL::to('/home/Uitloggen') }}" class="">Uitloggen</a>
            </li>
        </ul>
    </aside>

    
<div class="container">
    <div class="is-size-1 has-text-primary m-t-lg">Dashboard </div>
    <hr>    

    
    @yield('content')
</div>
</section>
            

@include('layout.layout_footer')

