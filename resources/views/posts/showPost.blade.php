@include('../layout.layout_header')

<body>
    <div class="backButton p-md ">
        <a class="" href="{{ URL::to('/' . $categorie->titel) }}"><button class="button is-medium">Terug</button></a>
    </div>

    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-6"><span class="is-size-3 ">{{$post->titel}}</span> @if(!$post->verified)<small>( Niet geverifierd! )</small>@endif</div>
            
            
            
            @if (Auth::user() && Auth::user()->level >= 3)
            <div class="card column is-6 p-b-xxs p-t-md has-text-centered">
                <script>
                    function submitForm() {
                        return confirm('Weet je zeker dat je deze post wilt verwijderen?');
                    }
                </script>

                <form method="POST" action="deletePostWithId" onsubmit="return submitForm(this);" enctype="multipart/form-data">
                    @csrf
                    <button type="button" class="button is-medium is-warning" onclick="showPersonalInfo()">Gebruikers info</button>
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <button class="button is-medium is-danger" type="submit">Post verwijderen</button>
                </form>
            </div>
            <script>
                function showPersonalInfo() {
                    var info = document.getElementById('user_info');
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
            </script>
            @endif
        </div>
        @if (Auth::user() && Auth::user()->level >= 3)
        <table id="user_info" hidden class="table is-striped is-fullwidth animated fadeOutUp">
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
                    <th>{{ $gebruiker->id }}</th>
                    <td>{{ $gebruiker->voornaam }}</td>
                    <td>{{ $gebruiker->achternaam }}</td>
                    <td>{{ $gebruiker->gender }}</td>
                    <td>{{ $gebruiker->email }}</td>
                    <td>{{ $gebruiker->telefoon }}</td>
                </tr>
                
            </tbody>
        </table>
        @endif
        <hr>

        <div class="column is-size-4">
            <div class="content">
                {!! $post->content !!}
            </div>
        </div>

        <br>

        <div class="columns is-gapless">
            @if ($post->directory != null)
            @php ($images = 0)
            @foreach (scandir(public_path() . "/". str_replace("public/", "/", $post->directory)) as $file)

            @if ((File::extension($file) == "png") || (File::extension($file) == "jpg") || (File::extension($file) ==
            "jpeg") || (File::extension($file) == "PNG") || (File::extension($file) == "JPG") ||
            (File::extension($file) == "JPEG"))
            @if ($file !== "." && $file !== "..")
            <div class="column is-1">
                <img onclick="open_plaatje({{ $images + 1 }})" class="image is-64x64" src="{{ asset($post->directory . "/" . $file) }}"
                    itemprop="thumbnail" alt="Image description" />
                @php ($images++)
            </div>

            <div id="plaatje-{{ $images }}" class="modal animated fadeIn">
                <div onclick="close_info()" class="modal-background"></div>
                <div class="container">
                    <div class="column">
                        <figure class="image">
                            <img src="{{ asset($post->directory . "/" . $file) }}">
                        </figure>
                    </div>
                </div>
                <button onclick="close_info()" class="modal-close is-large" aria-label="close"></button>

            </div>
            @endif
            @endif
            @endforeach
            <script>
                function close_info() {
                    console.log("X");
                    var elems = document.querySelectorAll(".modal");
                    [].forEach.call(elems, function (el) {
                        el.classList.remove("is-active");
                    });
                }

                function open_plaatje(num) {
                    var element = document.getElementById("plaatje-" + num);
                    element.classList.add("is-active");
                }
            </script>
            @endif

            @if($images == 0)
            
            @endif
        </div>

        <div class="column is-size-7">
            Gemaakt op: {{$post->datum}}<br>
            Gemaakt door: {{$gebruiker->voornaam}} {{$gebruiker->achternaam}}<br>
            Categorie: {{$categorie->titel}}<br><br>
        </div>

        <hr>
        @if (empty($replies))
        <div class="columns is-centered">
            <div class="column is-12 has-text-centered">
                Er is nog niemand die een reactie heeft gegeven. Wees de eerste door op deze knop de drukken.
                <br>
                @if($post->verified)
                <a href="{{ URL::to('/reageren/'.$post->id) }}"><button class="button is-primary is-outlined m-md">Reageren</button></a>
                @endif
            </div>
        </div>
        @else
        <div class="columns is-centered">
            <div class="column is-12 has-text-centered">
                @if (count($replies) > 0)
                In totaal hebben {{count($replies)}} mensen gereageerd
                <br>
                @if($post->verified)
                <a href="{{ URL::to('/reageren/'.$post->id) }}"><button class="button is-primary is-outlined m-md">Nog
                        een reactie
                        achterlaten</button></a>
                @endif
                @else
                Er heeft nog niemand een reactie achter gelaten.
                <br>
                @if($post->verified)
                <a href="{{ URL::to('/reageren/'.$post->id) }}"><button class="button is-primary is-outlined m-md">Een reactie
                        achterlaten</button></a>
                @endif
                @endif
                
            </div>
        </div>
        <div class="column content">
            @foreach ($replies as $reply)


            <blockquote>
                <div class="column is-12 has-text-centered">
                    @if (Auth::user() &&Auth::user()->level >= 3)
                    <div class="card column p-b-xxs p-t-md is-pulled-right has-text-centered">
                        <form method="POST" action="deleteReplyWithId" onsubmit="return submitForm(this);" enctype="multipart/form-data">
                            @csrf
                            <button type="button" class="button is-small is-warning" onclick="showReplyPersonalInfo({{ $reply->id }})">Gebruikers info</button>
                            <input type="hidden" name="id" value="{{ $reply->id }}">
                            
                            <button class="button is-small is-danger" type="submit">Reactie verwijderen</button>
                        </form>
                    </div>
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
                    </script>
                    @endif
                    <span class="">{{$reply->voornaam}} {{$reply->achternaam}} heeft een reactie achtergelaten. </span>
                </div>

                <div class="is-size-7 has-text-centered">{{$reply->datum}}</div>
                @if (Auth::user() && Auth::user()->level >= 3)
                    <table id="user_info{{$reply->id}}" hidden class="m-t-md table is-striped is-fullwidth animated fadeOutUp">
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
                                <th>{{ $reply->gebruikers_id }}</th>
                                <td>{{ $reply->voornaam }}</td>
                                <td>{{ $reply->achternaam }}</td>
                                <td>{{ $reply->gender }}</td>
                                <td>{{ $reply->email }}</td>
                                <td>{{ $reply->telefoon }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                @endif
            </blockquote>
            @endforeach
        </div>
        @endif


        <br>
    </div>
</body>
@include('../layout.layout_footer')

</html>