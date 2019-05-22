@include('../layout.layout_header')
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/bulma-checkradio.min.css') }}">

<body>
    <div class="container">
        <br>
        <div class="is-size-2">Contact</div>
        <div class="columns is-multiline is-variable bd-klmn-columns is-8">
            
            <div class="column is-7 is-12-mobile m-t-lg m-b-lg">
                <div class="is-size-4">Neem contact met ons op!</div>
                @if(session()->has('message'))
                    <div class="notification is-info animated">
                        <button class="delete"></button>
                        <ul>
                            <li>{{ session()->get('message') }}</li>
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
                <form method="POST" action="verstuur_contact_formulier">
                    @csrf
                    <div class="field">
                        <div class="label">Voornaam:</div>
                        <div class="control">
                            <input class="input" type="text" id="voornaam" name="voornaam"  value="{{ old('voornaam') }}" required autofocus>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">Achternaam:</div>
                        <div class="control">
                            <input class="input" type="text" id="achternaam" name="achternaam" value="{{ old('achternaam') }}" required>
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
                        <div class="label">Bericht:</div>
                        <div class="control">
                            <textarea class="" type="text" id="bericht" name="content" required>{{ old('content') }}</textarea>
                        </div>
                    </div>
                    <script>
                        CKEDITOR.replace('bericht', {
                            height: "300",
                            resize: true,

                        });
                    </script>
                    <br>
                    <div class="field">
                        <input type="checkbox" id="checkbox" class="is-checkradio is-info" name="voorwaarden" required>
                        <label for="checkbox"> Ja, ik ga akkoord met de <a href="{{ URL::to('voorwaarden') }}">Algemene voorwaarden en Privacy statement.</a></label>
                    </div>
                    <br>
                    <div class="control">
                        <div class="control">
                            <input type="submit" id="button" class="button is-primary is-large" value="Versturen">
                        </div>
                    </div>
                </form>
                
            </div>
            
            <div class="column is-5 is-12-mobile is-hcentered m-t-lg m-b-lg">
                <div class="is-size-4">Onze gegevens:</div>
                <table class="table is-fullwidth is-hidden-touch">
                    <tbody>
                        <tr>
                            <td>Email: </td>
                            <td>{{ $contact->email }}</td>
                        </tr>
                        <tr>
                            <td>Naam: </td>
                            <td>{{ $contact->naam }}</td>
                        </tr>
                        <tr>
                            <td>Plaats: </td>
                            <td>{{ $contact->plaats }}</td>
                        </tr>
                        <tr>
                            <td>Postcode + stad: </td>
                            <td>{{ $contact->postcode_stad }}</td>
                        </tr>
                        <tr>
                            <td>Telefoon: </td>
                            <td>{{ $contact->telefoon }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="is-hidden-desktop">
                    <br>
                    <b>Email:</b> <br>
                    {{ $contact->email }}<br>
                    <b>Naam:</b> <br>
                    {{ $contact->naam }}<br>
                    <b>Plaats:</b> <br>
                    {{ $contact->plaats }}<br>
                    <b>Postcode + stad:</b> <br>
                    {{ $contact->postcode_stad }}<br>
                    <b>Telefoon:</b> <br>
                    {{ $contact->telefoon }}<br>
                </div>
            </div>
        </div>
    </div>
</body>
@include('../layout.layout_footer')

</html>