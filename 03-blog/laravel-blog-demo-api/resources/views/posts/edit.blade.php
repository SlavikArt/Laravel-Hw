<x-layout title="Редагувати пост">
    <div class="container">
        <div class="section">
            <h1 class="title">Редагувати пост</h1>

            @if ($errors->any())
                <div class="notification is-danger">
                    <button class="delete"></button>
                    <h2 class="subtitle">Помилки валідації:</h2>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('posts.update', $post) }}">
                @csrf
                @method('PUT')

                <div class="field">
                    <label class="label">ID Користувача</label>
                    <div class="control has-icons-left">
                        <input class="input @error('user_id') is-danger @enderror"
                               type="text"
                               name="user_id"
                               value="{{ old('user_id', $post->user_id) }}"
                               placeholder="Введіть ID користувача">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    @error('user_id')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">Заголовок</label>
                    <div class="control has-icons-left">
                        <input class="input @error('title') is-danger @enderror"
                               type="text"
                               name="title"
                               value="{{ old('title', $post->title) }}"
                               placeholder="Введіть заголовок поста">
                        <span class="icon is-small is-left">
                            <i class="fas fa-heading"></i>
                        </span>
                    </div>
                    @error('title')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">Текст</label>
                    <div class="control">
                        <textarea class="textarea @error('content') is-danger @enderror"
                                  name="content"
                                  placeholder="Введіть текст поста"
                                  rows="8">{{ old('content', $post->content) }}</textarea>
                    </div>
                    @error('content')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">URL зображення</label>
                    <div class="control has-icons-left">
                        <input class="input @error('image') is-danger @enderror"
                               type="url"
                               name="image"
                               value="{{ old('image', $post->image) }}"
                               placeholder="https://example.com/image.jpg">
                        <span class="icon is-small is-left">
                            <i class="fas fa-image"></i>
                        </span>
                    </div>
                    @error('image')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="is_publish"
                                   value="1" {{ old('is_publish', $post->is_publish) ? 'checked' : '' }}>
                            Опублікувати
                        </label>
                    </div>
                    @error('is_publish')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label class="label">Теги (ULIDs)</label>
                    <div class="control has-icons-left">
                        <input class="input @error('tags') is-danger @enderror"
                               type="text"
                               name="tags[]"
                               value="{{ old('tags', $post->tags->pluck('id')->implode(',')) }}"
                               placeholder="Введіть ULIDs тегів через кому">
                        <span class="icon is-small is-left">
                            <i class="fas fa-tags"></i>
                        </span>
                    </div>
                    @error('tags')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-primary">
                            <span class="icon">
                                <i class="fas fa-save"></i>
                            </span>
                            <span>Оновити</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="{{ route('posts.index') }}" class="button is-light">
                            <span class="icon">
                                <i class="fas fa-times"></i>
                            </span>
                            <span>Скасувати</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
