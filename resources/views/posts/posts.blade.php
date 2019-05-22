@include('layout.layout_header')

<body>
    <div class="container">
        <br>
        <div class="is-size-2"><?= ucfirst(trans($category)) ?></div>
            <br>
            <div class="is-size-5"><?= $getOmschrijving[0] ?> </div>

            <br>
            <button onclick="open_info()" class="button is-primary is-outlined is-small">Meer info</button>
            <script>
                function open_info() {
                    var element = document.getElementById("info_modal");
                    element.classList.add("is-active");
                }
            </script>
            <div id="info_modal" class="modal animated fadeIn">
                <div onclick="close_info()" class="modal-background"></div>
                <div class="container">
                    <div class="column">
                        <div class="box p-xl is-size-5">
                            <?= $getInformatie[0] ?>
                        </div>
                    </div>
                </div>
                <button onclick="close_info()"  class="modal-close is-large" aria-label="close"></button>
                <script>
                    function close_info() {
                        var element = document.getElementById("info_modal");
                            element.classList.remove("is-active");
                    }
                </script>
              </div>
            
            <hr>
            <span id="berichten"></span>
            @if(count($getPosts) > 0)
            @foreach ($getPosts as $post)
            @if (file_exists($post->directory))
            <br>
            <div class="columns">
                <div class="column box animated fadeIn	">
                    <div class="column is-size-5 title 	is-clearfix">
                        <a class="" href="{{ url('posts/'.$post->id ) }}">{{ucfirst(trans($post->titel))}}</a>  
                    </div>
                    <hr>
                    <div class="columns">
                            @if ($post->directory != null && file_exists($post->directory))
                            @if (count(array_slice(scandir(public_path() . "/". str_replace("public/", "/", $post->directory)),2)) > 0)
                            @php $image = (array_slice(scandir(public_path() . "/". str_replace("public/", "/", $post->directory)),2)[0]); @endphp
                            @if ((File::extension($image) == "png") || (File::extension($image) == "jpg") || (File::extension($image) ==
                                "jpeg") || (File::extension($image) == "PNG") || (File::extension($image) == "JPG") ||
                                (File::extension($image) == "JPEG"))
                            <div class="column ">
                                <img class="image is-64x64 is-centered" src="{{ URL::to('/'.$post->directory) }}/{{ $image }}" alt="" srcset="">
                            </div>
                            @else
                            <div class="column ">
                                <img class="image is-64x64 is-centered" src="{{ URL::to('/') }}/images/thumbnail.png" alt="" srcset="">
                            </div>
                            @endif
                            @else
                            <div class="column ">
                                <img class="image is-64x64 is-centered" src="{{ URL::to('/') }}/images/thumbnail.png" alt="" srcset="">
                            </div>
                            @endif
                            @endif

                        <div class="column is-four-fifths">{!! str_limit($post->content, 230)  !!} </div>
                    </div>
                    <div class="column is-paddingless">
                        <a href="{{ url('posts/'.$post->id) }}"><button class="button is-primary is-outlined">bekijk meer</button></a>
                        <span class="is-pulled-right is-size-7 m-t-md">Gemaakt op: {{  date('d-m-Y', strtotime($post->datum)) }}</span>
                    </div>
                </div>
            </div>
            <br>
            @endif
            @endforeach
            <div>
            @if ($getPosts->total() > 15)
                <nav class="pagination is-small" role="navigation" aria-label="pagination">
                    @if (!($getPosts->onFirstPage()))
                    <a class="pagination-previous" href="{{ $getPosts->previousPageUrl() }}#berichten">Vorige</a>
                    @endif
                    @if (!($getPosts->currentPage() == $getPosts->lastPage()))
                    <a class="pagination-next" href="{{ $getPosts->nextPageUrl() }}#berichten">Volgende</a>
                    @endif
                    <ul class="pagination-list">
                        @if ($getPosts->lastPage() > 3)
                            @if (!($getPosts->onFirstPage()))
                            <li><a class="pagination-link" aria-label="Goto page 1" href="{{ URL::current() }}?page=1#berichten">1</a></li>
                            <li><span class="pagination-ellipsis">&hellip;</span></li>
                            @endif
                        @endif
                        @if (!($getPosts->onFirstPage()))
                        <li><a class="pagination-link" aria-label="Goto page {{ $getPosts->currentPage() - 1 }}" href="{{ URL::current() }}?page={{ $getPosts->currentPage() - 1 }}#berichten">{{ $getPosts->currentPage() - 1 }}</a></li>
                        @endif
                        <li><a class="pagination-link is-current" aria-label="Page {{ $getPosts->currentPage() }}" aria-current="page">{{ $getPosts->currentPage() }}</a></li>
                        @if (!($getPosts->currentPage() == $getPosts->lastPage()))
                        <li><a class="pagination-link" aria-label="Goto page {{ $getPosts->currentPage() + 1 }}" href="{{ URL::current() }}?page={{ $getPosts->currentPage() + 1 }}#berichten">{{ $getPosts->currentPage() + 1 }}</a></li>
                        @endif
                        @if ($getPosts->lastPage() > 3)
                            @if (!($getPosts->currentPage() == $getPosts->lastPage()))
                            <li><span class="pagination-ellipsis">&hellip;</span></li>
                            <li><a class="pagination-link" aria-label="Goto page {{ $getPosts->lastPage() }}"  href="{{ URL::current() }}?page={{ $getPosts->lastPage() }}#berichten">{{ $getPosts->lastPage() }}</a></li>
                            @endif
                        @endif
                    </ul>
                </nav>
            @endif
            </div>
            @else
            
            <div>
                Nog geen posts in deze categorie, maak er een aan hier 
                <br><br>
                <a class="blueButton" href="{{ url('posts/create') }}">Nieuwe post</a>
            </div>

            @endif
            <br>
            <br>
        </div>
    </div>
</body>

@include('../layout.layout_footer')
</html>