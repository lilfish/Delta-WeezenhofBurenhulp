@extends('home')

@section('content')
<div class="container m-b-xl">
    <div class="is-size-3 m-b-xl" id="aantal">Aantal mails verzonden vandaag:</div>
    <div class="columns is-multiline p-b-md">
        <div class="column is-12">{{ $aantal_mails }}/1000 mails verzonden op {{ $date_now }}</div>
        <div class="column is-12">
            <progress class="progress is-primary" value="{{ $aantal_mails }}" max="1000">{{ $procent }}%</progress>
        </div>

    </div>

    <div class="is-size-3 m-b-xl" id="alle_mail">Alle Mails:</div>
    <div class="columns is-multiline">
        
        <div class="column is-12">
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

            <script>
                function showReplyPersonalInfo(id){
                    var info = document.getElementById('user_info' + id);
                    if(info.classList.contains('fadeInDown')){
                        info.classList.remove('fadeInDown');
                        info.classList.add('fadeOutUp')
                        setTimeout(() => {
                            info.hidden = true;
                        }, 1000);
                    } else {
                        info.classList.remove('fadeOutUp');
                        info.classList.add('fadeInDown')
                        info.hidden = false;
                    }
                }
                function toggleText(id) {
                    console.log("HOI");
                    var textHolder = document.getElementById('content' + id);
                    textHolder.classList.toggle("truncate");
                }
            </script>
            @if(count($all_mails) == 0)
            <div class="has-text-centered">
                Geen mails
            </div>
            @endif
            @foreach($all_mails as $mail)
                <div class="box">
                    <div class="content">
                        <p>
                            <strong>{{ $mail->voornaam }} {{ $mail->achternaam }}</strong> <small>({{ $mail->gender }}) </small><small class="is-pulled-right">{{ $mail->datum }}</small>
                            <hr class='m-t-xxs m-b-sm'>
                            <div class="p-b-xxxs"><b><u>{{ $mail->titel }}</u></b></div>
                            <br>
                            <div class="truncate my_truncate_box" id="content{{ $mail->id}}" onclick="toggleText({{ $mail->id}})">
                                {!! $mail->content !!}
                            </div>
                        </p>
                    </div>
                    <nav class="">
                        <div class="level-left">
                            <form class="m-none" method="POST" action="delete_mail" onsubmit="return confirm('Weet je zeker dat je deze mail wilt verwijderen?');" enctype="multipart/form-data">
                                @csrf
                                <button type="button" class="button is-small is-warning" onclick="showReplyPersonalInfo({{ $mail->id }})">Gebruikers info</button>
                                <input type="hidden" name="id" value="{{ $mail->id }}">
                                
                                <button class="button is-small is-danger" type="submit">Reactie verwijderen</button>
                            </form>
                        </div>
                    </nav>
                    <table id="user_info{{$mail->id}}" hidden class="m-t-md table is-striped is-fullwidth animated fadeOutUp">
                        <thead>
                            <tr>
                                <th><abbr title="Id">Id</abbr></th>
                                <th><abbr title="Voornaam">Voornaam</abbr></th>
                                <th><abbr title="Achternaam">Achternaam</abbr></th>
                                <th><abbr title="Gender">Gender</abbr></th>
                                <th><abbr title="Email">Email</abbr></th>
                                <th><abbr title="Telefoon">Telefoon</abbr></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <th>{{ $mail->gebruikers_id }}</th>
                                <td>{{ $mail->voornaam }}</td>
                                <td>{{ $mail->achternaam }}</td>
                                <td>{{ $mail->gender }}</td>
                                <td>{{ $mail->email }}</td>
                                <td>{{ $mail->telefoon }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            @endforeach
            @if ($all_mails->total() > 10)
                <nav class="pagination is-small" role="navigation" aria-label="pagination">
                    @if (!($all_mails->onFirstPage()))
                    <a class="pagination-previous" href="{{ $all_mails->previousPageUrl() }}">Previous</a>
                    @endif
                    @if (!($all_mails->currentPage() == $all_mails->lastPage()))
                    <a class="pagination-next" href="{{ $all_mails->nextPageUrl() }}">Next page</a>
                    @endif
                    <ul class="pagination-list">
                        @if ($all_mails->lastPage() > 3)
                            @if (!($all_mails->onFirstPage()))
                            <li><a class="pagination-link" aria-label="Goto page 1" href="{{ URL::to('/home/mail?page=') }}1">1</a></li>
                            <li><span class="pagination-ellipsis">&hellip;</span></li>
                            @endif
                        @endif
                        @if (!($all_mails->onFirstPage()))
                        <li><a class="pagination-link" aria-label="Goto page {{ $all_mails->currentPage() - 1 }}" href="{{ URL::to('/home/mail?page=') }}{{ $all_mails->currentPage() - 1 }}">{{ $all_mails->currentPage() - 1 }}</a></li>
                        @endif
                        <li><a class="pagination-link is-current" aria-label="Page {{ $all_mails->currentPage() }}" aria-current="page">{{ $all_mails->currentPage() }}</a></li>
                        @if (!($all_mails->currentPage() == $all_mails->lastPage()))
                        <li><a class="pagination-link" aria-label="Goto page {{ $all_mails->currentPage() + 1 }}" href="{{ URL::to('/home/mail?page=') }}{{ $all_mails->currentPage() + 1 }}">{{ $all_mails->currentPage() + 1 }}</a></li>
                        @endif
                        @if ($all_mails->lastPage() > 3)
                            @if (!($all_mails->currentPage() == $all_mails->lastPage()))
                            <li><span class="pagination-ellipsis">&hellip;</span></li>
                            <li><a class="pagination-link" aria-label="Goto page {{ $all_mails->lastPage() }}"  href="{{ URL::to('/home/mail?page=') }}{{ $all_mails->lastPage() }}">{{ $all_mails->lastPage() }}</a></li>
                            @endif
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>
@stop