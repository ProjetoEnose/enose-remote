<div class="users-list-contain card">
    <div class="card-header">
        <h2>Lista de usuários</h2>
    </div>
    <div class="input-search-contain">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input wire:model="search" type="search" placeholder="Buscar por nome...">
    </div>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Entrou</th>
                <th>É um administrador</th>
                <th>Gerenciar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        @php
                            $color = $user->is_admin ? '#07a007' : '#f01313';
                        @endphp
                        <span
                            style="color: {{ $color }}; border: 1px solid {{ $color }}; padding: 3px 5px; border-radius: 5px;">
                            {{ $user->is_admin ? 'Sim' : 'Não' }}
                        </span>
                    </td>
                    <td>
                        <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="post"
                        class="form-delete-user">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="btn-delete-user">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center">
                        <h2>Nenhum usuário encontrado</h2>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <button type="button" id="btn-add-new-user">
        <i class="fa-solid fa-circle-plus"></i>
        Adicionar novo usuário
    </button>
</div>
