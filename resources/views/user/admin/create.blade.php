@extends('page')

@section('specific-styles')
    @vite(['resources/css/user/admin/create.css', 'resources/css/alert.css'])
    @livewireStyles
@endsection

@section('content')
    @livewire('user-list') <!-- Inclui o componente Livewire -->

    @if ($successOnDelete or $successOnInsert)
        @php
            $title = 'Usuário ' . ($successOnInsert ? 'Inserido' : 'Deletado') . '!';
            $message =
                'O ' .
                ($successOnInsert ? 'novo(a) ' : '') .
                'usuário(a) <span style="font-weight: 600">' .
                ($newUserName ?? $userNameDeleted) .
                '</span> foi devidamente ' .
                ($successOnInsert ? 'registrado' : 'removido') .
                '.';
        @endphp

        <x-alert :title="$title" :message="$message"></x-alert>
    @endif
@endsection

@section('modal')
    <div class="modal-contain-form close-modal-contain">
        {{-- form de inserção de novo usuário --}}
        <form action="{{ route('user.store') }}" method="POST" class="card form-add-new-user">
            @csrf
            <i class="fa-solid fa-xmark" id="btn-close-modal-form"></i>

            <div class="card-header">
                <h2>Novo usuário</h2>
            </div>

            <div class="card-body">
                <div class="box">
                    <input type="text" name="name" value="{{ old('name') }}" id="input-name"
                        placeholder="Informe o nome">
                    <label for="">Nome</label>
                </div>
                @if ($errors->has('name'))
                    <span class="show-error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first('name') }}
                    </span>
                @endif
                <div class="error-message" id="name-error-message">
                    <span>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        preencha o campo acima
                    </span>
                </div>

                <div class="box">
                    <input type="email" name="email" value="{{ old('email') }}" id="input-email"
                        placeholder="Informe o email">
                    <label for="">E-mail</label>
                </div>
                @if ($errors->has('email'))
                    <span class="show-error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first('email') }}
                    </span>
                @endif
                <div class="error-message" id="email-error-message">
                    <span>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        preencha o campo acima
                    </span>
                </div>

                <div class="box">
                    <input type="password" name="password" value="{{ old('password') }}" id="input-password"
                        placeholder="Informe a senha">
                    <label for="">Senha</label>
                    <i class="fa-regular fa-eye" id="btn-show-password"></i>
                </div>
                @if ($errors->has('password'))
                    <span class="show-error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $errors->first('password') }}
                    </span>
                @endif
                <div class="error-message" id="password-error-message">
                    <span>
                        <i class="fa-solid fa-circle-exclamation"></i>
                        preencha o campo acima
                    </span>
                </div>

                <div class="box">
                    <span>Privilégios: </span>
                    <select name="is_admin">
                        <option value="false" {{ old('is_admin') == 'false' ? 'selected' : '' }}>Usuário</option>
                        <option value="true" {{ old('is_admin') == 'true' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>
            </div>

            <div class="footer-card">
                <button type="submit">Inserir</button>
            </div>
        </form>
    </div>
@endsection

@section('specific-scripts')
    @vite(['resources/js/user/admin/create.js', 'resources/js/alert.js'])

    @livewireScripts

    <script>
        // Verifica se existem erros e abre o modal caso existam
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', () => {
                // Lógica para abrir o modal
                document.querySelector('.modal-contain-form').classList.remove('close-modal-contain');
            });
        @endif
    </script>
@endsection
