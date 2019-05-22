@extends('home')

@section('content')
    <div class="columns is-multiline">
        <div class="is-size-3 column is-12">Alle gebruikers</div>
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
        <div class="table-container">
            <table class="table is-striped is-fullwidth m-b-md">
                <thead>
                    <tr>
                        <th><abbr title="Id">Id</abbr></th>
                        <th><abbr title="Voornaam">Voornaam</abbr></th>
                        <th><abbr title="Achternaam">Achternaam</abbr></th>
                        <th><abbr title="Gender">Gender</abbr></th>
                        <th><abbr title="Email">Email</abbr></th>
                        <th><abbr title="Telefoon">Telefoon</abbr></th>
                        <th><abbr title="Verwijder">Verwijder</abbr></th>
                    </tr>
                </thead>
                @if(count($gebruikers) > 10)
                <tfoot>
                    <tr>
                        <th><abbr title="Id">Id</abbr></th>
                        <th><abbr title="Voornaam">Voornaam</abbr></th>
                        <th><abbr title="Achternaam">Achternaam</abbr></th>
                        <th><abbr title="Gender">Gender</abbr></th>
                        <th><abbr title="Email">Email</abbr></th>
                        <th><abbr title="Telefoon">Telefoon</abbr></th>
                        <th><abbr title="Verwijder">Verwijder</abbr></th>
                    </tr>
                </tfoot>
                @endif
                <tbody>
                    @foreach ($gebruikers as $gebruiker)
                    <tr>
                        <th>{{ $gebruiker->id }}</th>
                        <td>{{ $gebruiker->voornaam }}</td>
                        <td>{{ $gebruiker->achternaam }}</td>
                        <td>{{ $gebruiker->gender }}</td>
                        <td>{{ $gebruiker->email }}</td>
                        <td>{{ $gebruiker->telefoon }}</td>
                        <form method="POST" action="delete_gebruiker" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                            @csrf
                            <th><abbr title="Verwijder"><button type="submit" class="is-small button is-danger">Verwijder</button></abbr></th>
                            <input type="hidden" name="gebruikers_id" value="{{ $gebruiker->id }}">
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
    @if ($gebruikers->total() > 60)
            <nav class="pagination is-small m-b-lg" role="navigation" aria-label="pagination">
                @if (!($gebruikers->onFirstPage()))
                <a class="pagination-previous" href="{{ $gebruikers->previousPageUrl() }}">Previous</a>
                @endif
                @if (!($gebruikers->currentPage() == $gebruikers->lastPage()))
                <a class="pagination-next" href="{{ $gebruikers->nextPageUrl() }}">Next page</a>
                @endif
                <ul class="pagination-list">
                    @if ($gebruikers->lastPage() > 3)
                        @if (!($gebruikers->onFirstPage()))
                        <li><a class="pagination-link" aria-label="Goto page 1" href="{{ URL::to('/home/gebruikers?page=') }}1">1</a></li>
                        <li><span class="pagination-ellipsis">&hellip;</span></li>
                        @endif
                    @endif
                    @if (!($gebruikers->onFirstPage()))
                    <li><a class="pagination-link" aria-label="Goto page {{ $gebruikers->currentPage() - 1 }}" href="{{ URL::to('/home/gebruikers?page=') }}{{ $gebruikers->currentPage() - 1 }}">{{ $gebruikers->currentPage() - 1 }}</a></li>
                    @endif
                    <li><a class="pagination-link is-current" aria-label="Page {{ $gebruikers->currentPage() }}" aria-current="page">{{ $gebruikers->currentPage() }}</a></li>
                    @if (!($gebruikers->currentPage() == $gebruikers->lastPage()))
                    <li><a class="pagination-link" aria-label="Goto page {{ $gebruikers->currentPage() + 1 }}" href="{{ URL::to('/home/gebruikers?page=') }}{{ $gebruikers->currentPage() + 1 }}">{{ $gebruikers->currentPage() + 1 }}</a></li>
                    @endif
                    @if ($gebruikers->lastPage() > 3)
                        @if (!($gebruikers->currentPage() == $gebruikers->lastPage()))
                        <li><span class="pagination-ellipsis">&hellip;</span></li>
                        <li><a class="pagination-link" aria-label="Goto page {{ $gebruikers->lastPage() }}"  href="{{ URL::to('/home/gebruikers?page=') }}{{ $gebruikers->lastPage() }}">{{ $gebruikers->lastPage() }}</a></li>
                        @endif
                    @endif
                </ul>
            </nav>
        @endif
</div>
@stop