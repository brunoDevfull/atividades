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

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade_cursos = $_POST['quantidade_cursos'];

    // Gera um novo ID para o usuário
    $novoId = 1; // Valor inicial
    if (!empty($_SESSION['categorias'])) {
        // Encontra o maior ID existente
        $maiorId = max(array_column($_SESSION['categorias'], 'id'));
        $novoId = $maiorId + 1; // Novo ID é o maior ID + 1
    }


    // Cria a nova categoria
    $novaCategoria = [
        'id' => $novoId,
        'nome' => $nome,
        'descricao' => $descricao,
        'quantidade_cursos' => $quantidade_cursos
    ];

    // Adiciona a nova categoria ao array na sessão
    array_push($_SESSION['categorias'], $novaCategoria);

    // Redireciona de volta para a página de categorias
    header('Location: categorias.php');
    exit;
}
?>

<body class="content">
    <?php require_once '../components/navbar.php'; ?>
    <?php require_once '../components/sidebar.php'; ?>
    <main class="content-grid">
        <h1>Cadastro de Categoria</h1>
        <form method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea>

            <label for="quantidade_cursos">Quantidade de Cursos:</label>
            <input type="number" id="quantidade_cursos" name="quantidade_cursos" required>

            <button type="submit">Salvar</button>
        </form>
    </main>
    <?php require_once '../components/footer.php'; ?>
    <script src="<?= VARIAVEIS['DIR_JS'] ?>main.js"></script>
</body>
</html>