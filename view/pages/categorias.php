<?php
session_start(); // Inicia a sessão

// Inclui o arquivo de configuração do ambiente
require_once '../../config/env.php';

// Inclui o cabeçalho da página
require_once '../components/head.php';

// Inclui o modelo CategoriasModel
require_once '../../model/CategoriasModel.php';

// Verifica se a sessão de categorias já existe
if (!isset($_SESSION['categorias'])) {
    // Se não existir, inicializa com os dados do CategoriasModel
    $_SESSION['categorias'] = CategoriasModel::$categorias;
}
?>

<body class="content">
    <?php
    // Inclui a barra de navegação
    require_once '../components/navbar.php';

    // Inclui a barra lateral
    require_once '../components/sidebar.php';
    ?>

    <main class="content-grid">
        <h1>Categoria de Cursos</h1>

        <!-- Link para cadastrar nova categoria -->
        <a href="cadastro_categoria.php" class="btn">
            <button type="button">
                <span>
                    Nova Categoria
                </span>
                <span class="material-symbols-outlined">
                    add
                </span>
            </button>
        </a>

        <!-- Tabela de Categorias -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Quantidade de Cursos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Acessa o array de categorias da sessão
                $categorias = $_SESSION['categorias'];

                // Exibe as categorias na tabela
                foreach ($categorias as $categoria) {
                    echo "
                    <tr>
                        <td>{$categoria['id']}</td>
                        <td>{$categoria['nome']}</td>
                        <td>{$categoria['descricao']}</td>
                        <td>{$categoria['quantidade_cursos']}</td>
                        <td>
                            <a href='edicao_categorias.php?id={$categoria['id']}'>
                                <button type='button'>
                                    <span class='material-symbols-outlined'>edit</span>
                                </button>
                            </a>
                            <a href='excluir_categorias.php?id={$categoria['id']}' class='btn-excluir'>
                                <button type='button'>
                                    <span class='material-symbols-outlined'>delete</span>
                                </button>
                            </a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </main>

    <?php
    // Inclui o rodapé da página
    require_once '../components/footer.php';
    ?>

    <!-- Script JavaScript -->
    <script src="<?= VARIAVEIS['DIR_JS'] ?>main.js"></script>
    <script src="<?= VARIAVEIS['DIR_JS'] ?>excluir_itens_tabela.js"></script>

</body>
</html>