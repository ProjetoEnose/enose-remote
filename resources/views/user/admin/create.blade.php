@extends('page')

@section('specific-styles')
    @vite(['resources/css/user/admin/create.css'])
@endsection

@section('content')
    {{-- container com a lista de usuários  --}}
    <div class="users-list-contain card">
        <div class="card-header">
            <h2>Lista de usuários</h2>
        </div>
        <div class="input-search-contain">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="searchTerm" id="search-term" placeholder="Busque aqui">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th colspan="2">E-mail</th> <!-- Colspan adicionado -->
                    <th>Entrou</th>
                    <th>É um administrador</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td colspan="2">{{ $user->email }}</td> <!-- Ocupa 2 colunas -->
                        <td>{{ $user->created_at->format('d/m/Y') }}
                        <td>
                            @php
                                $color = $user->is_admin ? '#07a007' : '#f01313';
                            @endphp
                            <span
                                style="color: {{ $color }}; border: 1px solid {{ $color }}; padding: 3px 5px; border-radius: 5px;">
                                {{ $user->is_admin ? 'Sim' : 'Não' }}
                            </span> <!-- Coluna normal -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <h2>Nenhum usuário registrado</h2>
                        </td> <!-- Ajuste para ocupar todas as colunas -->
                    </tr>
                @endforelse
            </tbody>
        </table>

        <button type="button" id="btn-add-new-user">
            <i class="fa-solid fa-circle-plus"></i>
            Adicionar novo usuário
        </button>
    </div {{-- exibe o modal informando a inserção de um novo usuário --}}>
    @if ($success)
        <div class="alert">
            <h3>
                <i class="fa-solid fa-check"></i>
                Usuário inserido!
            </h3>
            <div class="timer-line"></div>
            <p>O novo usuário <span style="font-weight: 600">{{ $newUserName }}</span> foi devidamente registrado.</p>
        </div>
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
    @vite(['resources/js/user/admin/create.js'])

    <script>
        // Verifica se existem erros e abre o modal caso existam
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                // Lógica para abrir o modal
                document.querySelector('.modal-contain-form').classList.remove('close-modal-contain');
            });
        @endif
    </script>
@endsection
