@props(['title', 'message'])

<div class="alert">
    <h3>
        <i class="fa-solid fa-check"></i>
        {{ $title }} <!-- Título passado como prop -->
    </h3>
    <div class="timer-line"></div>
    <p>
        {!! $message !!} <!-- Mensagem passada como prop -->
    </p>
</div>
