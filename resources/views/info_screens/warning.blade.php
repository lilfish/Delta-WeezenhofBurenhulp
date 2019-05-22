@include('layout.layout_header')


<body>




    <div class="container">
        <div class="content">
            <div class="columns is-multiline m-t-xl p-b-xl">
                <img class="big_center_image" src={{ URL::to('/') }}/images/warning.svg alt="" srcset="">
                <div class="column is-12 has-text-centered"><h1>{!! $message !!}</h1></div>
                <div class="column is-12 has-text-centered">
                <form method="POST" action="{{ URL::to('/' . $link) }}" class="myForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hash" value="{{ $hash }}">
                    <a href="{{ URL::to('/') }}"><button class="button is-large is-primary m-md" type="button" >Annuleren</button></a>
                    <button class="button is-large m-md" type="submit">Ik weet het zeker</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layout.layout_footer')

</html>