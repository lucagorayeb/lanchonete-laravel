/**
 * Lógica para gerenciar os links de categoria do Cardápio.
 * Remove a classe "active" dos outros links e adiciona ao link clicado.
 */
document.addEventListener('DOMContentLoaded', () => {
    const categoryLinks = document.querySelectorAll('.figma-category-link');

    categoryLinks.forEach((link) => {
        link.addEventListener('click', () => {
            categoryLinks.forEach((item) => item.classList.remove('active'));
            link.classList.add('active');
        });
    });
});
