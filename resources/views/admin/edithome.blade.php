@extends('home')


<script type="text/javascript" src="{{ asset('/js/ckeditor/ckeditor.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/bulma-slider.js') }}"></script>
<link rel="stylesheet" href={{ asset('css/bulma-slider.min.css') }}>
<link rel="stylesheet" href="{{ asset('css/bulma-checkradio.min.css') }}">

<script>
    var setTrue = false;
</script>

@section('content')
<div class="is-size-3 m-b-xl">Homepage aanpassen</div>
<div class="is-size-4 m-b-md" id="nieuwe_afbeelding">Carousel plaatjes</div>
<div class="columns is-multiline box">

    <div class="columns is-multiline m-t-md m-b-xl ">
        <div class="">
            <div class="actions">
                <a class="column m-l-sm">
                    <div class="file has-name">
                        <label class="file-label">
                            <input class="file-input" type="file" id="upload" value="Kies een afbeelding" accept="image/*" />

                            <span class="file-cta">
                                <span class="file-icon">
                                    <i class="fas fa-upload"></i>
                                </span>
                                <span class="file-label">
                                    Kies een afbeelding…
                                </span>
                            </span>
                            <span class="file-name" id="filename">

                            </span>
                        </label>
                    </div>
                </a>
                <script>
                    var file = document.getElementById("upload");
                    file.onchange = function () {
                        if (file.files.length > 0) {

                            document.getElementById('filename').innerHTML = file.files[0].name;
                            document.getElementById('uploaddemo').hidden = false;
                            setTrue = true;
                        }
                    };
                </script>
            </div>
        </div>
        <br>
        <div class="column is-12 m-b-xl">

            <div id="uploaddemo" class="upload-demo-wrap m-b-xl" hidden>
                <div id="upload-demo"></div>
            </div>
        </div>

        <div class="columns is-multiline">
            <div class="column is-6">
                <div class="field">
                    <label class="label">Naam</label>
                    <div class="control">
                        <input class="input" id="new_name" type="text" placeholder="Nieuw plaatje naam">
                    </div>
                    <p class="help">Dit is de nieuwe naam van het plaatje wat je hierboven upload</p>
                </div>
            
            </div>
            <div class="column is-6">
                <label class="label"> .</label>
                <button id="upload-image" onclick="loadfunction()" class=" upload-result button m-l-xl">Uploaden naar
                    de server</button>
                <script>
                    function loadfunction() {
                        if (setTrue){
                        document.getElementById('upload-image').classList.add('is-loading');
                        }
                    }
                </script>
            </div>
        </div>




    </div>
    <div id="upload-demo-i"></div>

    <script type="text/javascript" src="{{ asset('/js/jquery-3.3.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/croppie.js') }}"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var $uploadCrop;

        //mooiere knop
        function readFile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.upload-demo').addClass('ready');
                    $uploadCrop.croppie('bind', {
                        url: e.target.result
                    }).then(function () {
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                swal("Sorry - you're browser doesn't support the FileReader API");
            }
        }

        //croppie
        $uploadCrop = $('#upload-demo').croppie({
            viewport: {
                width: 960,
                height: 500,
            },
            boundary: {
                width: 960,
                height: 720
            },
            enableExif: true
        });

        //onchange maak canvas
        $('#upload').on('change', function () {
            readFile(this);
        });

        $('.upload-result').on('click', function (ev) {
            if ($('#new_name').val() != "") {
                $uploadCrop.croppie('result', {
                    type: 'canvas',
                    size: 'original',
                    format: 'png',
                    quality: parseInt(document.getElementById('sliderWithValue').value)
                }).then(function (resp) {
                    $.ajax({
                        url: "/add_carousel",
                        type: "POST",
                        data: {
                            "image": resp,
                            "name": $('#new_name').val()
                        },
                        success: function (data) {
                            if (data.success == "done") {
                                location.reload();
                            }
                        }
                    });

                });

            }
        });
    </script>
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}" />
</div>



<form method="POST" action="del_carousel" id="form" class="" enctype="multipart/form-data">
    @csrf
    <br>

    <div class="is-size-4 m-b-md" id="delete_afbeelding">Verwijderen carousel plaatjes</div>



    <div class="columns is-multiline box">
        <span class="column is-12"><u>Selecteer de plaatjes die verwijderd moeten worden:</u></span>
        @foreach (File::allFiles('carousel/') as $file)
        @if ($file !== "." && $file !== "..")
        <span class="column is-4">
            <div class="field">
                <figure class="image m-b-sm">
                    <img src="{{asset( $file )}}">
                </figure>
                <p class="control">
                    <div class="b-checkbox is-default">
                            <input type="checkbox" value="{{ $file }}" name="delete[]" id="delfile{{ $file }}" class="is-checkradio is-info">
                        <label for="delfile{{ $file }}">{{ $file }}</label>
                    </div>
                </p>
            </div>
        </span>
        @endif
        @endforeach
    </div>

    <div class="column is-12">
        <div class="column is-12">
            <input type="submit" class="button is-large is-primary" value="Verwijder">
        </div>
    </div>
    <br>
    <div class="col-12" style="visibility: hidden"></div>
</form>

<hr>

<div class="is-size-4 m-b-md m-t-xl" id="update_tekst">Homepage tekst aanpassen</div>
<form method="POST" action="updateHome" enctype="multipart/form-data">
    @csrf

    <textarea id="editor1" name="content">{!!  $artiekel[0]->content !!}</textarea>

    <script>
        CKEDITOR.replace( 'editor1', {
                height:"200",
                resize: true,
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
            });
    </script>

    <div class="col-12">
        <div class="col-12">
            <input type="submit" class="button is-large is-primary m-t-md m-b-xl" value="Update">
        </div>
    </div>

</form>


@stop