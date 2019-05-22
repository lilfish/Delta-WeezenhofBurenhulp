
@include('../layout.layout_header')
<link rel="stylesheet" href="{{ asset('css/image_upload.css') }}">
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/bulma-checkradio.min.css') }}">
<script src={{ asset('js/jquery-3.3.1.js') }}></script>

<body>
    <div class="container ">  
                <br>

                <div class="is-size-2">Nieuwe post aanmaken</div>

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
                            <input class="input" type="text" id="voornaam" name="voornaam" required autofocus value="{{ old('voornaam') }}">
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
                            <input class="input" class="control" type="text" id="email" name="email"  value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">Telefoon nummer:</div>
                        <div class="control">
                            <input class="input" type="text" id="tel" name="telefoon"  value="{{ old('telefoon') }}" required>
                        </div>
                    </div>

                    <br>

                    <div class="field">
                        <p class="control">
                            <div class="b-checkbox is-default">
                                <input type="checkbox" id="rememberChkBox" class="is-checkradio is-info">
                                <label for="rememberChkBox"> Onthoud deze gegevens</label>
                            </div>
                        </p>
                    </div>
                    
                    <hr>
                    
                    <div class="is-size-5">Post aanmaken</div>

                    <div class="field">
                        <div class="label">Categorie:</div>
                        <div class="control">
                            <div class="select">
                                <select name="categorie" >
                                    <option value="" disabled selected>Kies een categorie</option>
                                    @foreach ($allCategories as $categorie)
                                        <option @if(old('categorie') == $categorie->id) {{ "selected" }} @endif value="{{$categorie->id}}">{{$categorie->titel}}</option> 
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <div class="label">Titel:</div>
                        <div class="control">
                            <input class="input" type="text" id="titel" name="titel"  value="{{ old('titel') }}" required>
                        </div>
                    </div>

                    <div class="field">
                        <div class="label">Beschrijving:</div>
                        <div class="control">
                        <textarea class="" type="text" id="beschrijving" name="content" required>{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <div class="field">
                            <div class="label">Plaatjes:</div>
                                <div class="control">
                                    <div>
                                        <div class="wrap-custom-file" id="duplicater">
                                        <input type="file" name="image[]" id="image" accept=".gif, .jpg, .png" />
                                        <label  for="image">
                                            <span id="file_text">Plaatje 1</span>
                                        </label>
                                        </div>
                                    </div>

                                    <div>
                                        <span class="button is-primary is-outlined" id="meer_images">
                                            Meer plaatjes
                                        </span>
                                        <span class="button is-primary is-outlined" id="minder_images">
                                            Minder plaatjes
                                        </span>
                                    </div>

                            <script src="{{ asset('js/create_image_script.js') }}"></script>
                        </div>
                    </div>
                    <br>
                    <div class="field">
                        <input type="checkbox" id="checkbox" class="is-checkradio is-info" name="voorwaarden" required>
                        <label for="checkbox"> Ja, ik ga akkoord met de <a href="{{ URL::to('voorwaarden') }}">Algemene voorwaarden en Privacy statement.</a></label>
                    </div>
                    <br>
                    <br>
                    <div class="control">
                        <div class="control">
                            <input type="submit" id="button" class="button is-primary is-large" value="Aanmaken">
                        </div>
                    </div>
                    <br>
                    
                </form>
            </div>
        </div>
    </div>
</body>
@include('../layout.layout_footer')
</html>

