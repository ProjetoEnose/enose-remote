import { forms } from "../utils/forms/forms.js";

const getElemetsUpdatePasswordForm = () => {
    return {
        form: document.querySelector("form"),
        inputs: {
            inputCurrentPassword: {
                element: document.getElementById("input-current-password"),
                errMsg: document.getElementById(
                    "current-password-error-message"
                ),
                btnShowPass: document.getElementById(
                    "btn-show-password-input-current"
                ),
            },
            inputNewPassword: {
                element: document.getElementById("input-new-password"),
                errMsg: document.getElementById("new-password-error-message"),
                btnShowPass: document.getElementById(
                    "btn-show-password-input-new"
                ),
            },
            inputConfirmNewPassword: {
                element: document.getElementById("input-confirm-new-password"),
                errMsg: document.getElementById(
                    "confirm-new-password-error-message"
                ),
                btnShowPass: document.getElementById(
                    "btn-show-password-input-confirm-new"
                ),
            },
        },
    };
};

function resetForm(inputs) {
    inputs.forEach((i) => {
        i.element.value = "";
        forms.showErrorMessage(i);
    });
}

(function addEventListenerInFormUpdatePasswordElements() {
    const { form, inputs } = getElemetsUpdatePasswordForm();
    const inputsList = Object.values(inputs);

    inputsList.forEach((input) =>
        input.btnShowPass.addEventListener("click", () =>
            forms.toggleTypeInputPass(input)
        )
    );

    forms.validateFormForSubmit({
        form: form,
        inputs: inputsList,
    });

    inputsList.forEach((i) =>
        i.element.addEventListener("input", () => forms.showErrorMessage(i))
    );
})();
