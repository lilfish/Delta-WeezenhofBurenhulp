@include('layout.layout_header')

<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>

<body>




    <div class="container">
        <div class="content">
            <div class="columns is-multiline m-t-xl p-b-xl">
                <img class="big_center_image" src={{ URL::to('/') }}/images/notfound.svg alt="" srcset="">
                <div class="column is-12 has-text-centered">
                    <h1>Pagina niet gevonden.</h1>
                    <h3><a href="{{ URL::to('/') }}">Klik hier om naar home te gaan</a></h3>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layout.layout_footer')

</html>