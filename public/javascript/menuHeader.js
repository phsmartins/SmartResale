const headerMenu = document.getElementById('headerMenu');
const mainMenu = document.querySelector('#mainMenu');

headerMenu.addEventListener('click', () => {
    mainMenu.classList.toggle('hidden');
});