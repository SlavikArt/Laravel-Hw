@props(['post'])

<div class="card post-card">
    @if($post->image)
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="{{ $post->image }}" alt="{{ $post->title }}">
            </figure>
        </div>
    @endif
    
    <div class="card-content">
        <div class="media">
            <div class="media-content">
                <p class="title is-4 post-title">
                    <a href="{{ route('posts.show', $post) }}">
                        {{ Str::limit($post->title, 50) }}
                    </a>
                </p>
                <p class="subtitle is-6">
                    <span class="icon-text">
                        <span class="icon">
                            <i class="fas fa-user"></i>
                        </span>
                        <span>{{ $post->author->name ?? 'Невідомий' }}</span>
                    </span>
                </p>
            </div>
        </div>

        <div class="content">
            <p class="has-text-grey">{{ Str::limit($post->content, 100) }}</p>
            
            <div class="level is-mobile">
                <div class="level-left">
                    <div class="level-item">
                        <span class="tag {{ $post->is_publish ? 'is-success' : 'is-warning' }} is-light">
                            {{ $post->is_publish ? 'Опубліковано' : 'Чернетка' }}
                        </span>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <small class="has-text-grey-light">
                            {{ $post->created_at->format('d.m.Y') }}
                        </small>
                    </div>
                </div>
            </div>

            @if($post->tags->count())
                <div class="tags">
                    @foreach($post->tags->take(3) as $tag)
                        <span class="tag is-info is-light is-small">{{ $tag->name }}</span>
                    @endforeach
                    @if($post->tags->count() > 3)
                        <span class="tag is-light is-small">+{{ $post->tags->count() - 3 }}</span>
                    @endif
                </div>
            @endif

            <div class="level is-mobile mt-3">
                <div class="level-left">
                    <div class="level-item">
                        <span class="icon-text">
                            <span class="icon has-text-grey">
                                <i class="fas fa-comments"></i>
                            </span>
                            <span class="has-text-grey">{{ $post->comments->count() }}</span>
                        </span>
                    </div>
                    <div class="level-item ml-3">
                        <span class="icon-text">
                            <span class="icon has-text-grey">
                                <i class="fas fa-heart"></i>
                            </span>
                            <span class="has-text-grey">{{ $post->likes->count() }}</span>
                        </span>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <a href="{{ route('posts.show', $post) }}" class="button is-small is-outlined">
                            Читати
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
