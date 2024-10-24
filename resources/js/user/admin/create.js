import { forms } from "../../utils/forms/forms.js";

function getElements() {
    return {
        btnShowAddNewUserForm: document.getElementById("btn-add-new-user"),
    };
}

function getElementsFormDeleteUser() {
    return {
        formsDeleteUser: document.querySelectorAll(".form-delete-user"),
    };
}

function getAddNewUserFormElements() {
    return {
        form: document.querySelector(".form-add-new-user"),
        inputs: {
            inputName: {
                element: document.getElementById("input-name"),
                errMsg: document.getElementById("name-error-message"),
            },
            inputEmail: {
                element: document.getElementById("input-email"),
                errMsg: document.getElementById("email-error-message"),
            },
            inputPassword: {
                element: document.getElementById("input-password"),
                errMsg: document.getElementById("password-error-message"),
                btnShowPass: document.getElementById("btn-show-password"),
            },
        },
    };
}

const getElemetsModal = () => {
    return {
        modalForm: {
            element: document.querySelector(".modal-contain-form"),
            btnClose: document.getElementById("btn-close-modal-form"),
        },
    };
};

function resetForm(inputs) {
    inputs.forEach((i) => {
        i.element.value = "";
        forms.showErrorMessage(i);
    });
}

(function addEventListenerInFormAddNewUserElements() {
    const { form, inputs } = getAddNewUserFormElements();
    const inputsList = Object.values(inputs);

    inputs.inputPassword.btnShowPass.addEventListener("click", () =>
        forms.toggleTypeInputPass(inputs.inputPassword)
    );

    forms.validateFormForSubmit({
        form: form,
        inputs: inputsList,
    });

    inputsList.forEach((i) =>
        i.element.addEventListener("input", () => forms.showErrorMessage(i))
    );

    /* Adiciona os listener aos modais de adição de novo usuário e alerta */
    const { modalForm } = getElemetsModal();
    [modalForm].forEach((modal) => {
        const { btnClose, element } = modal;

        if (btnClose !== null) {
            btnClose.addEventListener("click", () => {
                forms.toggleVisibilityModal(element);
                resetForm(inputsList);
            });
        }
    });

    const { btnShowAddNewUserForm } = getElements();

    btnShowAddNewUserForm.addEventListener("click", () =>
        forms.toggleVisibilityModal(modalForm.element)
    );

    /* lógica do form de deleção de usuário */
    const { formsDeleteUser } = getElementsFormDeleteUser();
    formsDeleteUser.forEach((form) => {
        form.onsubmit = (event) => {
            event.preventDefault();

            // Captura a linha da tabela (tr) que contém o formulário
            const userRow = event.target.closest("tr");

            // Aqui você pode manipular a linha e os dados dela, por exemplo:
            const userName = userRow.querySelector("td:first-child").innerText;

            // Pergunta de confirmação
            const userConfirmed = confirm(
                `Tem certeza de que deseja remover ${userName}?`
            );

            // Submete o formulário após a confirmação
            if (userConfirmed) form.submit();
        };
    });
})();
