<x-layout title="Помилка">
    <div class="container">
        <div class="section">
            <div class="notification is-danger">
                <h1 class="title is-4">🚨 Супер помилка!</h1>
                <p class="subtitle is-6">Код помилки: {{ $code ?? 500 }}</p>
                <p>{{ $message ?? 'Сталася супер помилка!' }}</p>
            </div>
            
            <div class="buttons">
                <a href="{{ url('/') }}" class="button is-primary">
                    <span class="icon">
                        <i class="fas fa-home"></i>
                    </span>
                    <span>На головну</span>
                </a>
                <a href="{{ url()->previous() }}" class="button is-light">
                    <span class="icon">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span>Назад</span>
                </a>
            </div>
        </div>
    </div>
</x-layout>
