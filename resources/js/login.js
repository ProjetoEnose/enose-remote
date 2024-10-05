import { forms } from "./utils/forms/forms.js";

const getElemetsLoginForm = () => {
    return {
        loginForm: document.getElementById("log-in-form"),
        inputEmail: {
            element: document.getElementById("input-email"),
            errMsg: document.getElementById("email-error-message"),
        },
        inputPassword: {
            element: document.getElementById("input-password"),
            errMsg: document.getElementById("password-error-message"),
            btnShowPass: document.getElementById("btn-show-password"),
        },
    };
};

const getElemetsModal = () => {
    return {
        modal: document.querySelector(".modal-contain"),
        btnCloseModal: document.getElementById("btb-close-modal"),
    };
};

window.onload = () => {
    const { loginForm, inputPassword, inputEmail } = getElemetsLoginForm();

    const inputsList = [inputEmail, inputPassword];

    forms.validateFormForSubmit({
        form: loginForm,
        inputs: inputsList,
    });

    inputPassword.btnShowPass.addEventListener("click", () =>
        forms.toggleTypeInputPass(inputPassword)
    );

    inputsList.forEach((i) =>
        i.element.addEventListener("input", () => forms.showErrorMessage(i))
    );

    inputEmail.element.focus();

    const { btnCloseModal, modal } = getElemetsModal();
    [btnCloseModal, modal].forEach((e) => {
        if (e !== null)
            e.addEventListener("click", () =>
                forms.toggleVisibilityModal(modal)
            );
    });
};
