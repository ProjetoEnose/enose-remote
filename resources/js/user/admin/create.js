import { forms } from "../../utils/forms/forms.js";

function getElements() {
    return {
        btnShowAddNewUserForm: document.getElementById("btn-add-new-user"),
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
        modalAlert: {
            element: document.querySelector(".modal-contain"),
            btnClose: document.getElementById("btb-close-modal"),
        },
    };
};

function resetForm(inputs) {
    inputs.forEach((i) => {
        i.element.value = "";
        forms.showErrorMessage(i);
    });
}

function animationTimer(timerLine, alertModal) {
    // Define a duração total em milissegundos (por exemplo, 5 segundos)
    const totalTime = 5000;
    let remainingTime = totalTime;

    // Seleciona o elemento da linha do timer

    // Define o intervalo de atualização (a cada 100 ms)
    const intervalTime = 100;

    // Função que atualiza a largura da linha
    const intervalId = setInterval(() => {
        remainingTime -= intervalTime;

        // Calcula a largura proporcional restante
        const percentage = (remainingTime / totalTime) * 100;
        timerLine.style.width = `${percentage}%`;

        // Quando o tempo acabar, limpar o intervalo
        if (remainingTime <= 0) {
            clearInterval(intervalId);
            alertModal.classList.add("exit");
            timerLine.style.width = "0%"; // Certifica-se de que a linha desapareça completamente
        }
    }, intervalTime);
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
    const { modalForm, modalAlert } = getElemetsModal();
    [modalForm, modalAlert].forEach((modal) => {
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

    const timerLine = document.querySelector(".timer-line");
    const alertModal = document.querySelector(".alert");
    if (alertModal != null) animationTimer(timerLine, alertModal);
})();
