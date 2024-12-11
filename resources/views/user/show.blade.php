@extends('page')

@section('specific-styles')
    @vite('resources/css/user/show.css')
@endsection

@section('content')
    @php
        $pathToProfileImage = $user->profileImage
            ? "storage/{$user->profileImage->path}"
            : sprintf('/images/avatars/%s.png', strtoupper($user->name[0]));
    @endphp
    <div class="user-card card" id="about-user">
        <div class="about">
            <h1 id="name">{{ $user->name }}</h1>
            <span>{{ $user->email }}</span>
            <span>
                @php
                    $cbCreatedAt = \Carbon\Carbon::parse($user->created_at);
                    $entered = $cbCreatedAt->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y');
                    $enteredDiffForHumans = $cbCreatedAt->diffForHumans();
                @endphp

                Juntou-se a equipe E-nose Remoto:
                <span style="background: var(--separator); padding: 4px; border-radius: 5px;">
                    {{ $entered }}
                    ({{ $enteredDiffForHumans }})
                </span>
            </span>
        </div>
        <div class="profile-image">
            <img src="{{ asset($pathToProfileImage) }}" alt="user" />
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
