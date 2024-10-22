@extends('page')

@section('specific-styles')
    @vite('resources/css/user/show.css')
@endsection

@section('content')
    <div class="user-card card">
        <div class="about">
            <span id="name">{{ $user->name }}</span>
            <span>{{ $user->email }}</span>
            <span>
                @php
                    $cbCreatedAt = \Carbon\Carbon::parse($user->created_at);
                    $entered = $cbCreatedAt->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y');
                    $enteredDiffForHumans = $cbCreatedAt->diffForHumans();
                @endphp

                Juntou-se a equipe Enose Remote:
                <span style="background: var(--separator); padding: 4px; border-radius: 5px;">
                    {{ $entered }}
                    ({{ $enteredDiffForHumans }})
                </span>
            </span>
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
                <span class="value">{{ $user->name }}</span>
            </div>
            <div class="line-blur">
                <span class="name">e-mail:</span>
                <span class="value">{{ $user->email }}</span>
            </div>
            <div class="line">
                <span class="name">senha:</span>
                <span class="value">
                    <input type="password" value="{{ $user->password }}" readonly />
                </span>
            </div>
            <div class="line-blur">
                <span class="name">status do e-mail:</span>
                <span class="value">{{ $user->email_verified_at ? 'validado' : 'não validado' }}</span>
            </div>
        </div>
        <div class="user-info-card-footer">
            <a href="{{ route('user.edit', ['user' => $user->id]) }}" id="btn-edit-user-settings">Atualizar perfil
            </a>
        </div>
    </div>
@endsection

@section('specific-scripts')
@endsection
