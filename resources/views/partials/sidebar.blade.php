@if (count($mostCommentedPosts) > 0)
    <div class="widget">
        <h3>Articles les plus commentés</h3>
            @foreach ($mostCommentedPosts as $featuredPost)
                <a href="{{ route('actu', $featuredPost->id) }}" class="item valign inverse">
                    @if ($featuredPost->thumbnail)
                        <img src="{{ $featuredPost->smallThumbnail }}">
                    @endif
                    <h4>
                        {{ $featuredPost->title }}<br>
                        <small>{{ $featuredPost->created_at }} - {{ $featuredPost->comments_count }}</small>
                    </h4>
                </a>
            @endforeach

    </div>
@endif

<div class="widget">
    <h3>Le lycée sur Twitter</h3>
    <a class="twitter-timeline" href="https://twitter.com/ecolemultimedia" data-height="200" data-chrome="nofooter noborders noheader">Tweets by ecolemultimedia</a>
</div>