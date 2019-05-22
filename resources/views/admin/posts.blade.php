@extends('home')

@section('content')
    <div class="columns is-multiline">
        <div class="is-size-3 column is-12">Alle posts</div>
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
                <div class="table-container">
                    <table class="table is-striped is-fullwidth m-b-md">
                        <thead>
                            <tr>
                                <th><abbr title="Id">Id</abbr></th>
                                <th><abbr title="Titel">Titel</abbr></th>
                                <th><abbr title="Gebruiker Id">Gebruiker Id</abbr></th>
                                <th><abbr title="Verifieerd">Verifieerd</abbr></th>
                                <th><abbr title="Afgehandeld">Afgehandeld</abbr></th>
                                <th><abbr title="Datum">Datum</abbr></th>
                                <th><abbr title="Bekijk">Bekijk</abbr></th>
                                <th><abbr title="verify">(Niet/wel) Verifiëren</abbr></th>
                                <th><abbr title="afhandellen">(Niet/wel) Afhandellen</abbr></th>
                                <th><abbr title="Verwijder">Verwijder</abbr></th>
                            </tr>
                        </thead>
                        @if(count($posts) > 10)
                        <tfoot>
                            <tr>
                                <th><abbr title="Id">Id</abbr></th>
                                <th><abbr title="Titel">Titel</abbr></th>
                                <th><abbr title="Gebruiker Id">Gebruiker Id</abbr></th>
                                <th><abbr title="Verifieerd">Verifieerd</abbr></th>
                                <th><abbr title="Afgehandeld">Afgehandeld</abbr></th>
                                <th><abbr title="Datum">Datum</abbr></th>
                                <th><abbr title="Bekijk">Bekijk</abbr></th>
                                <th><abbr title="verify">(Niet) Verifiëren</abbr></th>
                                <th><abbr title="afhandellen">(Niet) Afhandellen</abbr></th>
                                <th><abbr title="Verwijder">Verwijder</abbr></th>
                            </tr>
                        </tfoot>
                        @endif
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <th>{{ $post->id }}</th>
                                <td>{{ $post->titel }}</td>
                                <td>{{ $post->gebruiker_id }}</td>
                                <td>{{ $post->verified }}</td>
                                <td>{{ $post->afgehandeld }}</td>
                                <td>{{ $post->datum }}</td>
                                <td><a href="{{ URL::to('posts/'.$post->id) }}">Klik hier om te bekijken</a></td>
                                <form method="POST" action="admin_verify_post" onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verifiëren?');">
                                    @csrf
                                    <th><abbr title="Verwijder"><button type="submit" class="is-small button is-primary">Verifiëren</button></abbr></th>
                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                </form>
                                <form method="POST" action="admin_handelaf_post" onsubmit="return confirm('Weet je zeker dat je dit bericht wilt afhandellen?');">
                                    @csrf
                                    <th><abbr title="Verwijder"><button type="submit" class="is-small button is-warning">Afhandellen</button></abbr></th>
                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                </form>
                                <form method="POST" action="admin_delete_post" onsubmit="return confirm('Weet je zeker dat je dit bericht wilt verwijderen?');">
                                    @csrf
                                    <th><abbr title="Verwijder"><button type="submit" class="is-small button is-danger">Verwijder</button></abbr></th>
                                    <input type="hidden" name="id" value="{{ $post->id }}">
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($posts->total() > 50)
                    <nav class="pagination is-small m-b-lg" role="navigation" aria-label="pagination">
                        @if (!($posts->onFirstPage()))
                        <a class="pagination-previous" href="{{ $posts->previousPageUrl() }}">Previous</a>
                        @endif
                        @if (!($posts->currentPage() == $posts->lastPage()))
                        <a class="pagination-next" href="{{ $posts->nextPageUrl() }}">Next page</a>
                        @endif
                        <ul class="pagination-list">
                            @if ($posts->lastPage() > 3)
                                @if (!($posts->onFirstPage()))
                                <li><a class="pagination-link" aria-label="Goto page 1" href="{{ URL::to('/home/posts?page=') }}1">1</a></li>
                                <li><span class="pagination-ellipsis">&hellip;</span></li>
                                @endif
                            @endif
                            @if (!($posts->onFirstPage()))
                            <li><a class="pagination-link" aria-label="Goto page {{ $posts->currentPage() - 1 }}" href="{{ URL::to('/home/posts?page=') }}{{ $posts->currentPage() - 1 }}">{{ $posts->currentPage() - 1 }}</a></li>
                            @endif
                            <li><a class="pagination-link is-current" aria-label="Page {{ $posts->currentPage() }}" aria-current="page">{{ $posts->currentPage() }}</a></li>
                            @if (!($posts->currentPage() == $posts->lastPage()))
                            <li><a class="pagination-link" aria-label="Goto page {{ $posts->currentPage() + 1 }}" href="{{ URL::to('/home/posts?page=') }}{{ $posts->currentPage() + 1 }}">{{ $posts->currentPage() + 1 }}</a></li>
                            @endif
                            @if ($posts->lastPage() > 3)
                                @if (!($posts->currentPage() == $posts->lastPage()))
                                <li><span class="pagination-ellipsis">&hellip;</span></li>
                                <li><a class="pagination-link" aria-label="Goto page {{ $posts->lastPage() }}"  href="{{ URL::to('/home/posts?page=') }}{{ $posts->lastPage() }}">{{ $posts->lastPage() }}</a></li>
                                @endif
                            @endif
                        </ul>
                    </nav>
                @endif
        </div>
</div>


@stop