<?php
session_start();

// Inclui o arquivo de configuração do ambiente
require_once '../../config/env.php';

// Inclui o cabeçalho da página
require_once '../components/head.php';

// Inclui o modelo CategoriasModel
require_once '../../model/CategoriasModel.php';

// Verifica se a sessão de categorias já existe
if (!isset($_SESSION['categorias'])) {
    // Se não existir, inicializa com os dados do ArtigosModel
    $_SESSION['categorias'] = CategoriasModel::$categorias;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade_cursos = $_POST['quantidade_cursos'];

    // Busca a categoria no array da sessão
    foreach ($_SESSION['categorias'] as &$categoria) {
        if ($categoria['id'] == $id) {
            // Atualiza os dados da categoria
            $categoria['nome'] = $nome;
            $categoria['descricao'] = $descricao;
            $categoria['quantidade_cursos'] = $quantidade_cursos;
            break;
        }
    }

    // Redireciona de volta para a página de categorias
    header('Location: categorias.php');
    exit;
}

// Recupera o ID da categoria da URL
$id = $_GET['id'] ?? null;

// Busca a categoria correspondente no array da sessão
$categoria = null;
foreach ($_SESSION['categorias'] as $item) {
    if ($item['id'] == $id) {
        $categoria = $item;
        break;
    }
}
?>

<body class="content">
    <?php require_once '../components/navbar.php'; ?>
    <?php require_once '../components/sidebar.php'; ?>
    <main class="content-grid">
        <h1>Edição de Categoria</h1>
        <?php if ($categoria) : ?>
            <form method="POST" action="">
                <!-- Campo oculto para enviar o ID da categoria -->
                <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= $categoria['nome'] ?>">

                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao"><?= $categoria['descricao'] ?></textarea>

                <label for="quantidade_cursos">Quantidade de Cursos:</label>
                <input type="number" id="quantidade_cursos" name="quantidade_cursos" value="<?= $categoria['quantidade_cursos'] ?>">

                <button type="submit">Salvar</button>
            </form>
        <?php else : ?>
            <p>Categoria não encontrada.</p>
        <?php endif; ?>
    </main>
    <?php require_once '../components/footer.php'; ?>
    <script src="<?= VARIAVEIS['DIR_JS'] ?>main.js"></script>
</body>
</html>