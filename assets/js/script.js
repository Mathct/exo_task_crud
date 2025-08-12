
const tasks = document.querySelectorAll('.task');
const modals = document.querySelectorAll('.modal');
const closes = document.querySelectorAll('.close');
const closecreate = document.querySelectorAll('.closecreate');
const closeupdate = document.querySelectorAll('.closeupdate');
var modalcreate_container = document.getElementById('modalcreate_container');
var modalupdate_container = document.getElementById('modalupdate_container');
const create = document.getElementById('create');
const modify = document.querySelectorAll('.btn-modify');


tasks.forEach(task => {
    task.addEventListener('click', () => {
        window.location.href = 'index.php?task=' + task.id;
    });
});

modal_container.addEventListener('click', () => {
    modal_container.style.display = "none";
    window.location.href = 'index.php';
});

modalcreate_container.addEventListener('click', () => {
    modalcreate_container.style.display = "none";
    window.location.href = 'index.php';
});

modalupdate_container.addEventListener('click', () => {
    modalcreate_container.style.display = "none";
    window.location.href = 'index.php';
});

modals.forEach(modal => {
    modal.addEventListener('click', (event) => {
        event.stopPropagation(); 
    });
});

closes.forEach(close => {
    close.addEventListener('click', () => {
        window.location.href = 'index.php';
    });
});

create.addEventListener('click', () => {
    modalcreate_container.style.display = "block";
});

closecreate.forEach(closecreate => {
    closecreate.addEventListener('click', () => {
        modalcreate_container.style.display = "none";
       
    });
});

modify.forEach(modify => {
    modify.addEventListener('click', () => {
        modal_container.style.display = "none";
        modalupdate_container.style.display = "block";
       
    });
});

closeupdate.forEach(closeupdate => {
    closeupdate.addEventListener('click', () => {
        modalupdate_container.style.display = "none";
        window.location.href = 'index.php';
       
    });
});