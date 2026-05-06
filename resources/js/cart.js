/**
 * Lida com o envio de formulários do carrinho de forma assíncrona (AJAX).
 * Utilizado pelos botões de Adicionar (+), Remover (-) e Excluir Item (Lixeira).
 * Em vez de recarregar a página, atualiza o DOM apenas na div correspondente (.figma-cart-container)
 */
window.submitCartAjax = async function(event, formElement) {
    event.preventDefault();
    
    const container = document.querySelector('.figma-cart-container');
    if (container) container.style.opacity = '0.6';

    try {
        const formData = new FormData(formElement);
        const response = await fetch(formElement.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (response.ok) {
            const html = await response.text();
            const doc = new DOMParser().parseFromString(html, 'text/html');
            
            const sidebar = document.getElementById('cartSidebar');
            const isSidebarOpen = sidebar ? sidebar.classList.contains('is-open') : false;

            const newContainer = doc.querySelector('.figma-cart-container');
            if (newContainer && container) {
                container.innerHTML = newContainer.innerHTML;
                
                if (isSidebarOpen) {
                    const newSidebar = document.getElementById('cartSidebar');
                    if (newSidebar) newSidebar.classList.add('is-open');
                }
            }
        }
    } catch (error) {
        console.error('Erro ao atualizar carrinho:', error);
    } finally {
        if (container) container.style.opacity = '1';
    }
};
