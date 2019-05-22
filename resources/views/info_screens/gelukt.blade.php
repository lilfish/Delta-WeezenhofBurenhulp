@include('layout.layout_header')

<link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>

<body>




    <div class="container">
        <div class="content">
            <div class="columns is-multiline m-t-xl p-b-xl">
                <img class="big_center_image" src={{ URL::to('/') }}/images/icons8-checkmark.svg alt="" srcset="">
                <div class="column is-12 has-text-centered"><h1>{!! $message !!}</h1></div>
            </div>
        </div>
    </div>
</body>
@include('layout.layout_footer')

</html>