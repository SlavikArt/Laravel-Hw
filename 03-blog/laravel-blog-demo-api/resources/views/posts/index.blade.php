<x-layout title="Пости">
    <div class="container">
        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <h1 class="title is-2">Пости</h1>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <a href="{{ route('posts.create') }}" class="button is-primary is-medium">
                        <span class="icon">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span>Створити новий пост</span>
                    </a>
                </div>
            </div>
        </div>

        @if(request('search') || request('status') || request('author') || request('sort'))
            <div class="notification is-info is-light">
                <div class="content">
                    <strong>Фільтри:</strong>
                    @if(request('search'))
                        <span class="tag is-info">Пошук: "{{ request('search') }}"</span>
                    @endif
                    @if(request('status'))
                        <span class="tag is-info">Статус: {{ request('status') }}</span>
                    @endif
                    @if(request('author'))
                        <span class="tag is-info">Автор: {{ request('author') }}</span>
                    @endif
                    @if(request('sort'))
                        <span class="tag is-info">Сортування: {{ request('sort') }}</span>
                    @endif
                    <a href="{{ route('posts.index') }}" class="button is-small is-info is-outlined ml-2">
                        Очистити фільтри
                    </a>
                </div>
            </div>
        @endif

        <div class="columns is-multiline">
            @foreach($posts as $post)
                <div class="column is-3">
                    <x-posts.card :post="$post" />
                </div>
            @endforeach
        </div>

        @if($posts->hasPages())
            <div class="section">
                {{ $posts->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</x-layout>
