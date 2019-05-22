<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset('css/app.css') }}>

    <title>Weezenhof Burenhulp</title>
</head>
<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
<link rel="stylesheet" href="{{ asset('css/bulma-carousel.min.css') }}">
<script src="{{ asset('js/bulma-carousel.js') }}"></script>

<body>
    {{-- @include('layout.layout_header') --}}
    <section class="hero is-light is-fullheight has-carousel">

        <div class="hero-carousel carousel-animated carousel-animate-fade" data-autoplay="true">
            <div class='carousel-container'>
                @foreach (scandir(public_path() . "/carousel/") as $file)
                @if (ends_with($file, ['.png', '.jpg', '.jpeg', '.gif']))
                @if ($loop->first)
                <div class='carousel-item has-background is-active'>
                    @else
                    <div class='carousel-item has-background'>
                        @endif
                        <img class="is-background" src="{{ URL::to('/') }}/carousel/{{ $file }}" alt="" />
                    </div>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>

        <div class="hero-head">
            <header class="navbar">


                <a class="navbar-item is-home-logo" href="{{ URL::to('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Weezenhof Burenhulp" width="200" height="100%">
                </a>
                @if (Auth::user())
                <div class="loginButtonHomepage is-hidden-touch">
                    <a class="p-lg button is-white" href={{ URL::to('/home') }}>
                        <div>Ingelogd als {{ Auth::user()->name }} <div class="is-size-7">Dashboard</div>
                        </div>
                    </a>
                </div>
                @endif
            </header>
        </div>

        <div class="hero-body p-t-xxs">
            <div class="container has-text-centered ">
                {!! $home_text[0]->content !!}
                <h1 class="title">
                    <!-- Primary bold title -->
                </h1>
                <h2 class="subtitle">
                    <!-- Primary bold subtitle -->
                </h2>
            </div>
        </div>

        <div class="hero-foot">
            <nav class="is-boxed is-fullwidth has-text-left">
                <div class="m-md">
                    <ul>
                        <li class="is-active button is-medium is-primary m-b-sm">
                            <a class="p-l-md p-r-md m-sm" href="{{ URL::to('/') }}">
                                Home
                            </a>
                        </li>
                        <li class="button is-medium is-primary m-b-sm">
                            <a class="m-sm" href="{{ URL::to('/posts/create') }}">
                                Post aanmaken
                            </a>
                        </li>
                        <li class="dropdown is-up m-b-sm">
                            <div class="dropdown is-hoverable is-up">
                                <div class="dropdown-trigger">
                                    <button class="button is-medium is-primary " aria-haspopup="true" aria-controls="dropdown-menu4">
                                        <span>
                                            <a class="m-sm" href="{{ URL::to('/categorieen') }}">
                                                Categorieen
                                            </a>
                                        </span>
                                    </button>
                                </div>
                                <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                                    <div class="dropdown-content ">

                                        @foreach ($allCategories as $categorie)
                                        <a class="dropdown-item " href="{{ URL::to('/'.$categorie->titel) }}">{{$categorie->titel}}</a>
                                        @endforeach
                                    </div>


                                </div>
                            </div>
                        </li>

                        <li class="button is-medium is-primary m-b-sm">
                            <a class="" href="{{ URL::to('/contact') }}">
                                Contact
                            </a>
                        </li>
                        <li class="button is-medium is-primary m-b-sm">
                            <a class="" href="{{ URL::to('/help') }}">
                                Hulp nodig?
                            </a>
                        </li>
                        @if (Auth::user())
                        <li class="is-hidden-desktop is-medium is-primary m-b-sm">
                            <a class="p-lg button is-white" href={{ URL::to('/home') }}>
                                <div>Ingelogd als {{ Auth::user()->name }} <div class="is-size-7">Dashboard</div>
                                </div>
                            </a>
                        </div>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>

    </section>
    <script>
        var carousels = bulmaCarousel.attach();
    </script>

    </div>
</body>

</html>