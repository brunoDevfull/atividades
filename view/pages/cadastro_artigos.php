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

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    // Gera um novo ID para o usuário
    $novoId = 1; // Valor inicial
    if (!empty($_SESSION['artigo'])) {
        // Encontra o maior ID existente
        $maiorId = max(array_column($_SESSION['artigo'], 'id'));
        $novoId = $maiorId + 1; // Novo ID é o maior ID + 1
    }


    // Cria o novo artigo
    $novoArtigo = [
        'id' => $novoId,
        'titulo' => $titulo,
        'conteudo' => $conteudo
    ];

    // Adiciona o novo artigo ao array na sessão
    array_push($_SESSION['artigo'], $novoArtigo);

    // Redireciona de volta para a página de artigos
    header('Location: artigos.php');
    exit;
}
?>

<body class="content">
    <?php require_once '../components/navbar.php'; ?>
    <?php require_once '../components/sidebar.php'; ?>
    
    <main class="content-grid">
        <h1>Cadastro de Artigo</h1>
        <form method="POST" action="">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="conteudo">Conteúdo:</label>
            <textarea id="conteudo" name="conteudo" required></textarea>

            <button type="submit">Salvar</button>
        </form>
    </main>
    <?php require_once '../components/footer.php'; ?>
    <script src="<?= VARIAVEIS['DIR_JS'] ?>main.js"></script>
</body>
</html>