@extends('page')

@section('specific-styles')
    @vite('resources/css/user.css')
@endsection

@section('content')
    <div class="user-card card">
        <div class="about">
            <span id="name">{{ $userName }}</span>
            <span>{{ $userEmail }}</span>
            <span>Entrou na ENOSE REMOTE em 11 de abril de 2023 (um ano atrás).</span>
        </div>
        <div class="profile-image">
            <img src="{{ $pathToProfileImage }}" alt="user" />
        </div>
    </div>

    <div class="user-info-card card">
        <div class="user-info-card-header">
            <h2>Informações pessoais</h2>
        </div>
        <div class="table-user-data">
            <div class="line">
                <span class="name">nome:</span>
                <span class="value">{{ $userName }}</span>
            </div>
            <div class="line-blur">
                <span class="name">e-mail:</span>
                <span class="value">{{ $userEmail }}</span>
            </div>
            <div class="line">
                <span class="name">senha:</span>
                <span class="value">
                    <input type="password" value="{{ $userPassword }}" readonly />
                </span>
            </div>
            <div class="line-blur">
                <span class="name">status do e-mail:</span>
                <span class="value">{{ $userEmailValidated ? 'validado' : 'não validado' }}</span>
            </div>
        </div>
        <div class="user-info-card-footer">
            <a href="{{ route('user.edit', ['user' => Auth::id()]) }}" id="btn-edit-user-settings">Atualizarperfil
            </a>
        </div>
    </div>

    <div class="delete-user-card card">
        <div class="delete-user-card-header">
            <h2>Deletar usuário</h2>
        </div>
        <div class="delete-user-card-body">
            Depois de excluir seu usuário, não há como voltar atrás. Por favor, tenha certeza.
            <a href="?deleteUser=true" id="btn-delete-user">Deletar usuário</a>
        </div>
    </div>
@endsection

@section('specific-scripts')
@endsection
