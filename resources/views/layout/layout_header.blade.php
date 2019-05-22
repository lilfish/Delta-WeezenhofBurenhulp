<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/app.css') }}>    
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <title>Weezenhof Burenhulp</title>
</head>

<nav class="navbar is-primary is-hidden-touch" role="navigation" aria-label="dropdown navigation">
    <div class="navbar-brand">
        <a class="navbar-item has-background-white" href="{{ URL::to('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Weezenhof Burenhulp" width="200" height="100%">
        </a>
    </div>
    <div class="navbar-start">
            <a class="navbar-item p-l-md p-r-md" href="{{ URL::to('/') }}">
                Home
            </a>
            <a class="navbar-item" href="{{ URL::to('/posts/create') }}">
                Post aanmaken
            </a>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="{{ URL::to('/categorieen') }}">
                    Categorieen
                </a>
                <div class="navbar-dropdown">
                    @foreach ($allCategories as $categorie)
                    <a class="navbar-item" href="{{ URL::to('/'.$categorie->slug) }}">{{ $categorie->titel}}</a>
                    @endforeach
                </div>
            </div>
            <a class="navbar-item" href="{{ URL::to('/contact') }}">
                Contact
            </a>
            <a class="navbar-item" href="{{ URL::to('/help') }}">
                Hulp nodig?
            </a>
    </div>
    @if (Auth::user())
    <div class="navbar-end">
            <a class="navbar-item" href={{ URL::to('/home') }}><div>Ingelogd als {{ Auth::user()->name }}  <div class="is-size-7">Dashboard</div></div></a>
    </div>
    @endif
</nav>


{{-- mobile view --}}

<div class="columns is-multiline is-mobile is-hidden-desktop m-b-none" style="margin-bottom: 0!important">
    <div class="column is-6 p-b-none">
        <a role="button" class="navbar-burger has-text-primary m-l-none " data-target="navMenu" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>
    <div class="navbar-brand column is-6 p-b-none">
        <a role="button" class="navbar-item is-hcentered" href="">
                <img src="{{ asset('images/logo.png') }}" alt="Weezenhof Burenhulp" width="200" height="100%">
        </a>
    </div>
</div>
<div class="has-background-white">
    <div class="navbar-menu is-shadowless p-none hamburger_menu" id="navMenu">
        <nav class="navbar is-white is-hidden-desktop" role="navigation" aria-label="dropdown navigation">
            <div class="navbar-start">
                    <a class="navbar-item p-l-md p-r-md" href="{{ URL::to('/') }}">
                        Home
                    </a>
                    <a class="navbar-item" href="{{ URL::to('/posts/create') }}">
                        Post aanmaken
                    </a>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link" href="{{ URL::to('/categorieen') }}">
                            Categorieen
                        </a>
                        <div class="navbar-dropdown">
                            @foreach ($allCategories as $categorie)
                            <a class="navbar-item" href="{{ URL::to('/'.$categorie->slug) }}">{{$categorie->titel}}</a>
                            @endforeach
                        </div>
                    </div>
                    <a class="navbar-item" href="{{ URL::to('/contact') }}">
                        Contact
                    </a>
                    <a class="navbar-item" href="{{ URL::to('/help') }}">
                        Hulp nodig?
                    </a>
            </div>
            @if (Auth::user())
            <div class="navbar-end">
                    <a class="navbar-item" href={{ URL::to('/home') }}><div>Ingelogd als {{ Auth::user()->name }}  <div class="is-size-7">Dashboard</div></div></a>
            </div>
            @endif
        </nav>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {

    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach( el => {
        el.addEventListener('click', () => {

        // Get the target from the "data-target" attribute
        const target = el.dataset.target;
        const $target = document.getElementById(target);

        // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
        el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

        });
    });
    }

});
</script>