@extends('home')


@section('content')
<div class="container m-b-xl">
    <div class="row">
        <div class="is-size-3 m-b-xl">Contact gegevens aanpassen</div>
        <div class="columns is-multiline">
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
            <div class="column is-12">
                <form method="POST" action="storeContact">
                    @csrf
                    <div class="field">
                        <div class="label">Contact Email:</div>
                        <div class="control">
                            <input class="input" value="{{ $contact->email or '' }}" class="control" type="text" id="ContactEmail" name="email" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">Naam & Achternaam:</div>
                        <div class="control">
                            <input class="input" value="{{ $contact->naam or '' }}" class="control" type="text" id="Naam" name="naam" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">Plaats:</div>
                        <div class="control">
                            <input class="input" value="{{ $contact->plaats or '' }}" class="control" type="text" id="Plaats" name="plaats" required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">Postcode + stad:</div>
                        <div class="control">
                            <input class="input" value="{{ $contact->postcode_stad or '' }}" class="control" type="text" id="postcodestad" name="postcodestad"
                                required>
                        </div>
                    </div>
                    <div class="field">
                        <div class="label">Telefoon:</div>
                        <div class="control">
                            <input class="input" value="{{ $contact->telefoon or '' }}" class="control" type="text" id="telefoon" name="telefoon" required>
                        </div>
                    </div>

                    <input type="submit" class="button is-primary is-large m-t-lg m-b-lg" value="Update">
                </form>
            </div>
        </div>
    </div>
</div>
@stop