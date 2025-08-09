
const tasks = document.querySelectorAll('.task');
const modals = document.querySelectorAll('.modal');
const closes = document.querySelectorAll('.close');


tasks.forEach(task => {
    task.addEventListener('click', () => {
        window.location.href = 'index.php?task=' + task.id;
    });
});

modal_container.addEventListener('click', () => {
    modal_container.style.display = "none";
    window.location.href = 'index.php';
});

modals.forEach(modal => {
    modal.addEventListener('click', (event) => {
        event.stopPropagation(); // 🔹 Empêche la propagation du clic
    });
});

closes.forEach(close => {
    close.addEventListener('click', () => {
        window.location.href = 'index.php';
    });
});