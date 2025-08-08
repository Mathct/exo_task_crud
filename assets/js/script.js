
const tasks = document.querySelectorAll('.task');

tasks.forEach(task => {
    task.addEventListener('click', () => {
        window.location.href = 'index.php?task='+task.id;
    });
});

modal.addEventListener('click', () => {
    modal.style.display = "none";
    window.location.href = 'index.php';
});