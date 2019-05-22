@include('layout.layout_header')
<link rel="stylesheet" href="{{ asset('css/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>

<body>




    <div class="container">
        <div class="content">
            <div class="columns is-multiline m-t-xl p-b-xl">
                <div class="col-12">
                    {!! $agreement !!}
                </div>
            </div>
        </div>
    </div>
</body>
@include('layout.layout_footer')

</html>