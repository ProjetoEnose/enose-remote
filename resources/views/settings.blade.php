@extends('page')

@section('specific-styles')
    @vite('resources/css/settings.css')
@endsection

@section('content')
    <form method="post" enctype="multipart/form-data" class="user-info-card card">
        <div class="user-info-card-header">
            <h2>Informações pessoais</h2>
        </div>
        <div class="table-user-data">
            <div class="line-blur">
                <span class="name">avatar:</span>
                <span class="value">
                    <img src="{{ $pathToProfileImage }}" alt="user-image" width="50px" id="profileImage" />
                    <input type="file" name="profileImage" id="inputProfileImage" readonly />
                    <label for="inputProfileImage" id="labelProfileImage">
                        nova foto
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </label>
                </span>
            </div>
            <div class="line">
                <span class="name">nome:</span>
                <span class="value">
                    <input type="text" name="name" value="{{ $userName }}" id="inputName" readonly />
                </span>
            </div>
            <div class="line-blur">
                <span class="name">e-mail:</span>
                <span class="value">
                    <input type="email" name="email" value="{{ $userEmail }}" id="inputEmail" readonly />
                </span>
            </div>
            <div class="line">
                <span class="name">senha:</span>
                <span class="value">
                    <input type="password" value="{{ $userPassword }}" id="inputPassword" readonly />
                </span>
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
                <button id="btn-confirm-edition">sim, alterar</button>
                <button id="btn-cancel-edition">não, mudei de ideia</button>
            </div>
        </div>
    </div>
@endsection

@section('specific-scripts')
@endsection
