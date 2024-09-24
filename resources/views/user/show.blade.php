@extends('page')

@section('specific-styles')
    @vite('resources/css/user/show.css')
@endsection

@section('content')
    <div class="user-card card">
        <div class="about">
            <span id="name">{{ $userName }}</span>
            <span>{{ $userEmail }}</span>
            <span>Entrou na ENOSE REMOTE em 11 de abril de 2023 (um ano atrás).</span>
        </div>
        <div class="profile-image">
            <img src="{{ asset(session('pathToProfileImage')) }}" alt="user" />
        </div>
    </div>

    <div class="user-info-card card">
        <div class="card-header">
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
            <a href="{{ route('user.edit', ['user' => Auth::id()]) }}" id="btn-edit-user-settings">Atualizar perfil
            </a>
        </div>
    </div>
@endsection

@section('specific-scripts')
@endsection
