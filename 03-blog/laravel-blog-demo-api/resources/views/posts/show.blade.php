<x-layout title="{{ $post->title }}">
    <div class="container">
        <div class="section">
            <div class="content">
                <h1 class="title is-1">{{ $post->title }}</h1>
                
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <div class="media">
                                <div class="media-left">
                                    <span class="icon is-medium">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </div>
                                <div class="media-content">
                                    <p class="subtitle is-5">{{ $post->author->name ?? 'Невідомий' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <span class="tag {{ $post->is_publish ? 'is-success' : 'is-warning' }} is-medium">
                                {{ $post->is_publish ? 'Опубліковано' : 'Чернетка' }}
                            </span>
                        </div>
                    </div>
                </div>
                
                @if($post->image)
                    <figure class="image is-16by9">
                        <img src="{{ $post->image }}" alt="{{ $post->title }}" class="has-rounded-corners">
                    </figure>
                @endif
                
                <div class="box">
                    <p class="is-size-5">{{ $post->content }}</p>
                </div>
                
                @if($post->tags->count())
                    <div class="tags">
                        @foreach($post->tags as $tag)
                            <span class="tag is-info is-medium">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                @endif
                
                <div class="level">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Коментарі</p>
                            <p class="title">{{ $post->comments->count() }}</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Лайки</p>
                            <p class="title">{{ $post->likes->count() }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <a href="{{ route('posts.edit', $post) }}" class="button is-info">
                                <span class="icon">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span>Редагувати</span>
                            </a>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <a href="{{ route('posts.index') }}" class="button is-light">
                                <span class="icon">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                <span>Назад</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
