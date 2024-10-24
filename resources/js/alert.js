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

/* lógica do alert de nova inserção */
const timerLine = document.querySelector(".timer-line");
const alertModal = document.querySelector(".alert");
if (alertModal != null) animationTimer(timerLine, alertModal);
