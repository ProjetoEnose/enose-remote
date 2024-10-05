function toggleTypeInputPass(inputPassword) {
    // const { inputPassword } = getElemetsLoginForm();

    switch (inputPassword.element.type) {
        case "password":
            inputPassword.btnShowPass.classList.remove("fa-eye");
            inputPassword.btnShowPass.classList.add("fa-eye-slash");
            inputPassword.element.setAttribute("type", "text");
            break;
        case "text":
            inputPassword.btnShowPass.classList.remove("fa-eye-slash");
            inputPassword.btnShowPass.classList.add("fa-eye");
            inputPassword.element.setAttribute("type", "password");
            break;
    }
}

function showErrorMessage(input, empty = false) {
    if (empty) {
        input.errMsg.classList.add("show-error-message");
    } else {
        input.errMsg.classList.remove("show-error-message");
    }
}

function validateInputs(inputs) {
    let allValid = true;

    inputs.forEach((i) => {
        const isEmpty = i.element.value.trim() === "";
        showErrorMessage(i, isEmpty);
        if (isEmpty) allValid = false;
    });

    return allValid;
}

function validateFormForSubmit(formElements) {
    const { form, inputs } = formElements;

    form.addEventListener("submit", (event) => {
        event.preventDefault();

        const allInputsValid = forms.validateInputs(inputs);

        if (allInputsValid) form.submit();
    });
}

function toggleVisibilityModal(modal) {
    modal.classList.toggle("close-modal-contain");
}

export const forms = {
    toggleTypeInputPass,
    showErrorMessage,
    validateInputs,
    validateFormForSubmit,
    toggleVisibilityModal,
};
