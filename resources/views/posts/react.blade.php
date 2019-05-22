@include('../layout.layout_header')
<script src="/js/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="{{ asset('css/bulma-checkradio.min.css') }}">
<script src={{ asset('js/jquery-3.3.1.js') }}></script>

<body>
    <div class="backButton p-md ">
        <a class="" href="{{ URL::previous() }}"><button class="button is-medium">Terug</button></a>
    </div>
    <div class="container">  
            <br>

            <div class="is-size-2">Reactie achterlaten</div>
            @if ($errors->any())
                <div class="notification is-info animated">
                    <button class="delete"></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
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
            <form method="POST" action="create" class="myForm" enctype="multipart/form-data">
                @csrf
                <div class="is-size-5">Belangrijke informatie:</div>
                <p>Om de website veilig te houden vragen wij voor uw naam, achternaam, email en telefoon nummer. Uw email en telefoonnummer zullen voor andere gebruikers op deze website niet te zien zijn.</p>
                
                <br>

                <div class="field">
                    <div  class="label">Voornaam:</div>
                    <div class="control">
                        <input class="input" type="text" id="voornaam" name="voornaam" required  value="{{ old('voornaam') }}" autofocus>
                    </div>
                </div>
                <div class="field">
                    <div  class="label">Achternaam:</div>
                    <div class="control">
                        <input class="input"  type="text" id="achternaam" name="achternaam" value="{{ old('achternaam') }}" required>
                    </div>
                </div>
                <div class="field">
                    <div class="label">Man/Vrouw:</div>
                    <input class="is-checkradio is-info " @if (old('gender') == "man") {{ "checked" }} @endif id="man" type="radio" name="gender"  value="man">
                    <label for="man">Man</label>
                    <input class="is-checkradio is-info" @if (old('gender') == "vrouw") {{ "checked" }} @endif  id="vrouw" type="radio" name="gender" value="vrouw">
                    <label for="vrouw">Vrouw</label>
                </div>
                <div class="field">
                    <div class="label">Email:</div>
                    <div class="control">
                        <input class="input" class="control" type="text" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="field">
                    <div class="label">Telefoon nummer:</div>
                    <div class="control">
                        <input class="input" type="text" id="tel" name="telefoon" value="{{ old('telefoon') }}" required>
                    </div>
                </div>

                <br>

                <div class="field">
                    <div class="control">
                        <input type="checkbox" id="rememberChkBox" class="is-checkradio is-info">
                        <label for="rememberChkBox"> Onthoud deze gegevens</label>
                    </div>
                </div>
                
                <hr>

                <div class="is-size-5">Reageren</div>

                        <div class="field">
                                <div class="label">Titel:</div>
                                <div class="control">
                                    <input class="input" type="text" id="titel" name="titel" value="Reactie op: {{$post->titel}} " readonly="readonly">
                                </div>
                            </div>
    
                        <div class="field">
                            <div class="label">Reactie:</div>
                            <div class="control">
                                <textarea type="text" id="beschrijving" name="content" required> {{ old('content') }}</textarea>
                            </div>
                        </div>
                        <input hidden type="text" id="post_id" name="post_id" value="{{$post->id}}"></input>
                        <br>
                        <div class="field">
                            <input type="checkbox" id="checkbox" class="is-checkradio is-info" name="voorwaarden" required>
                            <label for="checkbox"> Ja, ik ga akkoord met de <a href="{{ URL::to('voorwaarden') }}">Algemene voorwaarden en Privacy statement.</a></label>
                        </div>
                        <br>
                        <div class="control">
                            <div class="control">
                                <input type="submit" id="button" class="button is-primary is-large" value="Reageren">
                            </div>
                        </div>
                    <br>
                    </form>
                    <script>
                        CKEDITOR.replace( 'beschrijving', {
                            height:"300",
                            resize: true,
                            
                        });
                    </script>
                    <script src="{{ asset('js/react_script.js') }}"></script>
                </div>
            </div>
        </div>
    </body>
    @include('../layout.layout_footer')
    </html>