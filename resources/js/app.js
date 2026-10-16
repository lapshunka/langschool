
document.addEventListener('DOMContentLoaded', () => {
    const topBtn = document.createElement('button');
    topBtn.innerHTML = '▲';
    topBtn.className = 'scroll-top-btn';
    topBtn.title = 'Наверх';
    document.body.appendChild(topBtn);

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            topBtn.classList.add('show');
        } else {
            topBtn.classList.remove('show');
        }
    });

    topBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});