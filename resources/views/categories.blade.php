@include('layout.layout_header')

<body>
    <div class="container">
        <div class="content">
            <div class="columns is-multiline m-t-xl p-b-xl">
                @foreach ($all_categories as $categories)
                <div class="column is-6">
                  <div class="card bm--card-equal-height">
                        <div class="card-content">
                          <p class="title has-text-centered">{{ $categories->titel }}</p>
                          <div class="content">
                                {!! str_limit(strip_tags($categories->informatie), 250) !!}
                          </div>
                        </div>
                        <div class="card-footer">
                          <p class="card-footer-item">
                                <a href="{{ URL::to('/'.str_replace('.', '', str_replace(' ', '-', $categories->titel))) }}" class="card-footer-item button is-primary m-t-sm">bekijk</a>
                          </p>
                        </div>
                      </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
@include('layout.layout_footer')

</html>