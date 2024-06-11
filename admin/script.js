const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
  const li = item.parentElement;

  item.addEventListener('click', () => {
    allSideMenu.forEach(i => i.parentElement.classList.remove('active'));
    li.classList.add('active');
  });
});

const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', () => {
  sidebar.classList.toggle('hide');
});

if (window.innerWidth < 768) {
  sidebar.classList.add('hide');
}

const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', () => {
  document.body.classList.toggle('dark', switchMode.checked);
});

