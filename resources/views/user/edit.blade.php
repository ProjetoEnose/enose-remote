@extends('page')

@section('specific-styles')
    @vite('resources/css/user/edit.css')
@endsection

@section('content')
    {{-- trabalhado na atualização de informações --}}
    <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post" enctype="multipart/form-data"
        class="user-info-card card">

        @csrf
        @method('PUT')


        <div class="card-header">
            <h2>Informações pessoais</h2>
        </div>
        <div class="table-user-data">
            <div class="line-blur">
                <span class="name">avatar:</span>
                <span class="value">
                    <div class="box">
                        <img src="{{ session('pathToProfileImage') }}" alt="user-image" width="50px" id="profileImage" />
                        <input type="file" name="profileImage" id="inputProfileImage" readonly accept="image/*"
                            value="{{ old('profileImage') }}" />
                        <label for="inputProfileImage" id="labelProfileImage">
                            nova foto
                            <i class="fa-solid fa-file-arrow-up"></i>
                        </label>

                    </div>
                    @error('profileImage')
                        <span class="show-error-message">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $errors->first('profileImage') }}
                        </span>
                    @enderror
                </span>
            </div>

            <div class="line">
                <span class="name">nome:</span>
                <span class="value">
                    <div class="box">
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" id="inputName"
                            readonly />
                    </div>
                    @error('name')
                        <span class="show-error-message">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $errors->first('name') }}
                        </span>
                    @enderror
                    <div class="error-message" id="name-error-message">
                        <span>
                            <i class="fa-solid fa-circle-exclamation"></i>
                            preencha o campo acima
                        </span>
                    </div>
                </span>
            </div>

            <div class="line-blur">
                <span class="name">e-mail:</span>
                <span class="value">
                    <div class="box">
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" id="inputEmail"
                            readonly />
                    </div>
                    @error('email')
                        <span class="show-error-message">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $errors->first('email') }}
                        </span>
                    @enderror
                    <div class="error-message" id="email-error-message">
                        <span>
                            <i class="fa-solid fa-circle-exclamation"></i>
                            preencha o campo acima
                        </span>
                    </div>
                </span>
            </div>
            <div class="line">
                <span class="name">senha:</span>
                <div class="value">
                    <a href="">Alterar senha</a>
                </div>
            </div>
        </div>
        <div class="user-info-card-footer">
            <button id="btn-edit-user-settings" type="button">Editar informações</button>
            <div class="contain-btns-action">
                <button id="btn-save-edit-user-settings" type="button">Salvar</button>
                <button id="btn-calcel-edit-user-settings" type="button">Cancelar</button>
            </div>
        </div>
    </form>
@endsection

@section('modal')
    <div class="modal-contain">
        <div class="modal">
            <div class="header-modal">
                <img src="../public/assets/logo.png" alt="" width="80px">
            </div>
            <div class="body-modal">
                <h3>Alterar informações pessoais?</h3>
                <p>Essa ação atualizará suas informações de usuário.</p>
            </div>
            <div class="footer-modal">
                <button id="btn-confirm-edition" type="submit">sim, alterar</button>
                <button id="btn-cancel-edition">não, mudei de ideia</button>
            </div>
        </div>
    </div>
@endsection

@section('specific-scripts')
    @vite(['resources/js/user/edit.js'])

    <script>
        /* lógica de ativação do modo de edição em caso de erro */
        @if ($errors->any())
            /* inputs  */
            const inputName = document.getElementById("inputName");
            const inputEmail = document.getElementById("inputEmail");

            /* botão de exibição do modal de confirmação e os botões de ação */
            const btnEdit = document.getElementById("btn-edit-user-settings");
            const btnsActionsContain = {
                actionContain: document.querySelector(".contain-btns-action"),
                btnSaveEdition: document.getElementById(
                    "btn-save-edit-user-settings"
                ),
                btnCalcelEdition: document.getElementById(
                    "btn-calcel-edit-user-settings"
                ),
            };

            const {
                actionContain
            } = btnsActionsContain;

            [inputName, inputEmail].forEach((input) => {
                input.readOnly = !input.readOnly;
                input.classList.toggle("edition-mode");
            });

            btnEdit.classList.toggle("hide-btn-edit-user-settings");
            actionContain.classList.toggle("show-action-btns-contain");
            console.log("activeEditionMode function loaded");
        @endif ;
    </script>
@endsection
