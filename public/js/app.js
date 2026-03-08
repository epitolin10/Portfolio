// app.js — Portfolio public
document.getElementById('navToggle')?.addEventListener('click', function() {
    const links = document.querySelector('.nav-links');
    links?.classList.toggle('nav-links--open');
});