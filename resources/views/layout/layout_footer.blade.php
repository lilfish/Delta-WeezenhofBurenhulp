<div id="wrapper"></div>
<div class="footer  p-b-lg"> 
    <div class="container">
        <div class="columns is-multiline">
            <div class="column is-3">
                <ul>
                    <li class=""><a href={{ URL::to('/') }}>Home</a></li>
                    <li class=""><a href={{ URL::to('/posts/create') }}>Nieuwe post</a></li>
                    <li class=""><a href={{ URL::to('/contact') }}>Contact</a></li>
                    <li class=""><a href={{ URL::to('/help') }}>Help</a></li>
                    <li class=""><a href={{ URL::to('/voorwaarden') }}>Algemene voorwaarden</a></li>
                </ul>
            </div>
            <div class="column is-3">
                @foreach ($allCategories as $indexKey => $categorie)
                    
                        <ul>
                    
                        <li class=""><a href={{ URL::to('/'. $categorie->titel) }}>{{$categorie->titel}}</a></li>
                        </ul>
                @endforeach
            </div>

            <div class="column is-6 is-size-2 right">
                Weezenhof burenhulp
            </div>
            <div class="column is-12 is-size-7 has-text-centered m-t-md p-none">
                <strong>Weezenhof burenhulp</strong> door Vincent Venhuizen. 
            </div>
        </div>
    </div>
</div>
