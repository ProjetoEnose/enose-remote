import { forms } from "../utils/forms/forms.js";

const getModalElements = () => {
    return {
        modal: document.querySelector(".modal-contain"),
        buttons: {
            btnConfirmEdition: document.getElementById("btn-confirm-edition"),
            btnToDenyEdition: document.getElementById("btn-cancel-edition"),
        },
    };
};

const getFormElements = () => {
    return {
        form: document.querySelector("form"),
        profileImage: document.getElementById("profileImage"),
        inputs: {
            inputProfileImage: {
                element: document.getElementById("inputProfileImage"),
            },
            inputName: {
                element: document.getElementById("inputName"),
                errMsg: document.getElementById("name-error-message"),
            },
            inputEmail: {
                element: document.getElementById("inputEmail"),
                errMsg: document.getElementById("email-error-message"),
            },
        },
        buttons: {
            btnEdit: document.getElementById("btn-edit-user-settings"),
            btnsActionsContain: {
                actionContain: document.querySelector(".contain-btns-action"),
                btnSaveEdition: document.getElementById(
                    "btn-save-edit-user-settings"
                ),
                btnCalcelEdition: document.getElementById(
                    "btn-calcel-edit-user-settings"
                ),
            },
        },
    };
};

const toggleVisibilityModalConfirmEditions = () => {
    const { modal } = getModalElements();

    modal.classList.toggle("show-modal-contain");
};

const toggleModeInput = (input) => {
    input.element.readOnly = !input.element.readOnly;
    input.element.classList.toggle("edition-mode");
};

const showPreviewImageSelected = () => {
    const { inputProfileImage } = getFormElements().inputs;
    const { profileImage } = getFormElements();

    const image = inputProfileImage.element.files[0];
    const defaultImage = image.src;
    const fileReader = new FileReader();

    fileReader.onloadend = () => (profileImage.src = fileReader.result);

    if (image) {
        fileReader.readAsDataURL(image);
    } else {
        image.src = defaultImage;
    }
};

function activeEditionMode() {
    const { inputName, inputEmail } = getFormElements().inputs;
    const { btnEdit, btnsActionsContain } = getFormElements().buttons;
    const { actionContain } = btnsActionsContain;

    [inputName, inputEmail].forEach((input) => {
        toggleModeInput(input);
    });

    btnEdit.classList.toggle("hide-btn-edit-user-settings");
    actionContain.classList.toggle("show-action-btns-contain");
}

(function init() {
    const { btnEdit, btnsActionsContain } = getFormElements().buttons;
    const { inputProfileImage, inputName, inputEmail } =
        getFormElements().inputs;
    const { btnSaveEdition, btnCalcelEdition } = btnsActionsContain;
    const { btnConfirmEdition, btnToDenyEdition } = getModalElements().buttons;
    const { form } = getFormElements();

    /* adiciona o preview da image escolhida */
    inputProfileImage.element.addEventListener(
        "change",
        showPreviewImageSelected
    );

    /* ativa o modo de edição para os inputs */
    btnEdit.addEventListener("click", activeEditionMode);

    /* exibe o modal de confirmação para atualização */
    btnSaveEdition.addEventListener("click", () => {
        toggleVisibilityModalConfirmEditions();
    });

    /* desativa o modo de edição para os inputs */
    btnCalcelEdition.addEventListener("click", activeEditionMode);

    /* fecha o modal de confirmação para atualização */
    btnToDenyEdition.addEventListener(
        "click",
        toggleVisibilityModalConfirmEditions
    );

    const inputsList = [inputName, inputEmail];

    forms.validateFormForSubmit({
        form: form, // Aqui seleciona o form correto
        inputs: inputsList, // Inputs que serão validados
    });

    // Em vez de chamar form.submit diretamente, dispara o evento de submit do formulário
    btnConfirmEdition.addEventListener("click", () => {
        form.dispatchEvent(new Event("submit", { cancelable: true })); // Dispara o evento de submit
    });

    inputsList.forEach((i) =>
        i.element.addEventListener("input", () => forms.showErrorMessage(i))
    );
})();
