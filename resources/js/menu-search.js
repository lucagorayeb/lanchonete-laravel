/**
 * Lógica de Busca em Tempo Real no Cardápio.
 * Filtra os cards baseando-se no texto do input de busca e esconde seções vazias.
 */
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('[data-menu-search]');
    const cards = Array.from(document.querySelectorAll('[data-menu-card]'));
    const sections = Array.from(document.querySelectorAll('[data-menu-section]'));
    const empty = document.querySelector('[data-menu-empty]');

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            const term = searchInput.value.trim().toLowerCase();
            let visibleCards = 0;

            cards.forEach((card) => {
                const isVisible = card.dataset.search.includes(term);
                card.style.display = isVisible ? '' : 'none';
                if (isVisible) {
                    visibleCards += 1;
                }
            });

            sections.forEach((section) => {
                const hasVisibleCard = Array.from(section.querySelectorAll('[data-menu-card]')).some((card) => card.style.display !== 'none');
                section.style.display = hasVisibleCard ? '' : 'none';
            });

            if (empty) {
                empty.style.display = visibleCards ? 'none' : 'block';
            }
        });
    }
});
