document.addEventListener('DOMContentLoaded', () => {
    startApp();
});


function startApp() {
    dateSearch();
}

function dateSearch() {
    const dateInput = document.querySelector('#date');
    dateInput.addEventListener('input', (e) => {
        const selectedDate = e.target.value;
        window.location = `?date=${selectedDate}`;
    });
}