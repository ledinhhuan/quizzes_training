$(function () {
    function startTimer(duration, display) {
        let timer = duration;
        let start = Date.now(), diff, minutes, seconds;
        let interval = setInterval(function () {
            diff = timer - (((Date.now() - start) / 1000) | 0);

            minutes = (diff / 60) | 0;
            seconds = (diff % 60) | 0;

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
            if (display.textContent != null) {
                display.textContent = minutes + ":" + seconds;
            }

            localStorage.minutes = minutes;
            localStorage.seconds = seconds;

            if (diff <= 0) {
                clearInterval(interval);
                $('#quizz_submit').submit();
                localStorage.removeItem('minutes');
                localStorage.removeItem('seconds');
            }

        }, 1000);
    }

    let time = 60; //1 minutes
    if (Number(localStorage.seconds) < time) {
        let seconds = Number(localStorage.minutes) * 60;
        time = Number(localStorage.seconds) + seconds;
    }

    let display = document.querySelector('#time');
    startTimer(time, display);
});
