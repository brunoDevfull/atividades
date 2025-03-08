<?php
session_start(); // Inicia a sessão

// Inclui o arquivo de configuração do ambiente
require_once '../../config/env.php';

// Inclui o cabeçalho da página
require_once '../components/head.php';

// Inclui o modelo ArtigosModel
require_once '../../model/ArtigosModel.php';

// Verifica se a sessão de artigos já existe
if (!isset($_SESSION['artigo'])) {
    // Se não existir, inicializa com os dados do ArtigosModel
    $_SESSION['artigo'] = ArtigosModel::$artigo;
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
        <h1>Artigos</h1>
        <!-- Link para cadastrar nova categoria -->
        <a href="cadastro_artigos.php" class="btn">
            <button type="button">
                <span>
                    Novo Artigo
                </span>
                <span class="material-symbols-outlined">
                    add
                </span>
            </button>
        </a>

        <!-- Tabela de Artigos -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Conteúdo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Acessa o array de artigos da sessão
                    $artigos = $_SESSION['artigo'];

                    // Exibe os artigos na tabela
                    foreach ($artigos as $artigo) {
                        echo "
                        <tr>
                            <td>{$artigo['id']}</td>
                            <td>{$artigo['titulo']}</td>
                            <td>{$artigo['conteudo']}</td>
                            <td>
                                <a href='edicao_artigos.php?id={$artigo['id']}'>
                                    <button type='button'>
                                        <span class='material-symbols-outlined'>edit</span>
                                    </button>
                                </a>
                                <a href='excluir_artigos.php?id={$artigo['id']}' class='btn-excluir'>
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
        </div>
        
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