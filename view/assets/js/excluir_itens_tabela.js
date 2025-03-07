console.log("Excluir foi carregado")

//Script para a exclusao dos itens da tabela
document.querySelectorAll('.btn-excluir').forEach(btn => {
    btn.addEventListener('click', (e) => {
        if (!confirm('Tem certeza que deseja excluir este item da tabela ?')) {
            e.preventDefault(); // Cancela o redirecionamento se o usuário cancelar
        }
    });
});