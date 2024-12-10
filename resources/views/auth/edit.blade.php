@extends('page')

@section('specific-styles')
    @vite(['resources/css/auth/edit.css', 'resources/css/alert.css'])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Alterar senha</h2>
        </div>
        <form action="{{ route('auth.password.update.confirm', ['user' => $user->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="box-contain">
                <div class="box">
                    <input type="password" name="currentPassword" id="input-current-password"
                        value="{{ old('currentPassword') }}" placeholder="Informe sua senha atual">
                    <label for="">Senha atual</label>
                    <i class="fa-regular fa-eye" id="btn-show-password-input-current"></i>
                </div>
                @if ($errors->has('currentPassword'))
                    <span class="show-error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first('currentPassword') }}
                    </span>
                @endif
                @if (session('error'))
                    <span class="show-error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ session('error') }}
                    </span>
                @endif
                <div class="error-message" id="current-password-error-message">
                    <span>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        preencha o campo acima
                    </span>
                </div>
                <div class="box">
                    <input type="password" name="newPassword" id="input-new-password" placeholder="Informe sua nova senha"
                        value="{{ old('newPassword') }}">
                    <label for="">Nova senha</label>
                    <i class="fa-regular fa-eye" id="btn-show-password-input-new"></i>
                </div>
                @if ($errors->has('newPassword'))
                    <span class="show-error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first('newPassword') }}
                    </span>
                @endif
                <div class="error-message" id="new-password-error-message">
                    <span>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        preencha o campo acima
                    </span>
                </div>
                <div class="box">
                    <input type="password" name="confirmNewPassword" id="input-confirm-new-password"
                        placeholder="Confirme sua nova senha" value="{{ old('confirmNewPassword') }}">
                    <label for="">Confirmar nova
                        senha</label>
                    <i class="fa-regular fa-eye" id="btn-show-password-input-confirm-new"></i>
                </div>
                @if ($errors->has('confirmNewPassword'))
                    <span class="show-error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first('confirmNewPassword') }}
                    </span>
                @endif
                <div class="error-message" id="confirm-new-password-error-message">
                    <span>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        preencha o campo acima
                    </span>
                </div>
            </div>
            <button type="submit" id="btn-confirm-code">Alterar</button>
        </form>
    </div>

    @if ($passwordUpdated)
        @php
            $title = 'Sua senha foi atualizada!';
            $message = 'sua senha de acesso foi devidamente aualizada.';
        @endphp

        <x-alert :title="$title" :message="$message"></x-alert>
    @endif
@endsection

@section('specific-scripts')
    @vite(['resources/js/auth/edit.js', 'resources/js/alert.js'])
@endsection
