@extends('page')

@section('specific-styles')
    @vite(['resources/css/user/admin/create.css'])
@endsection

@section('content')
    <div class="users-list-contain card">
        <div class="card-header">
            <h2>Lista de usuários</h2>
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
    </div>
@endsection

@section('specific-scripts')
@endsection
