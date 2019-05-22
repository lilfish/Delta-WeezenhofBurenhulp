@extends('home')

@section('content')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>

    <div class="columns is-multiline">
        <div class="is-size-3 column is-12">Help aanpassen</div>
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
                <form method="POST" action="updateHelp" enctype="multipart/form-data">
                        @csrf
                        <textarea id="editor2" name="help_tekst" class="textarea">{!! $help !!}</textarea>
                        <br>
                        <div class="field">
                                <input type="submit" class="button is-primary is-large" value="Aanmaken">
                        </div>
                        <br>
                </form>
                <script>
                    $('.textarea').each(function (e) {
                        CKEDITOR.replace(this.id, {});
                    });
                </script>
        </div>
</div>


@stop