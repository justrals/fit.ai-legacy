document.addEventListener('DOMContentLoaded', (event) => {
    const dropbtn = document.querySelector('.dropbtn');
    const dropdownContent = document.getElementById('dropdownMenu');

    dropbtn.addEventListener('click', () => {
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', (event) => {
        if (!event.target.matches('.dropbtn')) {
            if (dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        }
    });
});
