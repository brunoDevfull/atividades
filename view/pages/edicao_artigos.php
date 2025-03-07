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
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];

    // Busca o artigo no array da sessão
    foreach ($_SESSION['artigo'] as &$artigo) {
        if ($artigo['id'] == $id) {
            // Atualiza os dados do artigo
            $artigo['titulo'] = $titulo;
            $artigo['conteudo'] = $conteudo;
            break;
        }
    }

    // Redireciona de volta para a página de artigos
    header('Location: artigos.php');
    exit;
}

// Recupera o ID do artigo da URL
$id = $_GET['id'] ?? null;

// Busca o artigo correspondente no array da sessão
$artigo = null;
foreach ($_SESSION['artigo'] as $item) {
    if ($item['id'] == $id) {
        $artigo = $item;
        break;
    }
}
?>

<body class="content">
    <?php require_once '../components/navbar.php'; ?>
    <?php require_once '../components/sidebar.php'; ?>
    <main class="content-grid">
        <h1>Editar Artigo</h1>
        <?php if ($artigo) : ?>
            <form method="POST" action="">
                <!-- Campo oculto para enviar o ID do artigo -->
                <input type="hidden" name="id" value="<?= $artigo['id'] ?>">

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?= $artigo['titulo'] ?>">

                <label for="conteudo">Conteúdo:</label>
                <textarea id="conteudo" name="conteudo"><?= $artigo['conteudo'] ?></textarea>

                <button type="submit">Salvar</button>
            </form>
        <?php else : ?>
            <p>Artigo não encontrado.</p>
        <?php endif; ?>
    </main>
    <?php require_once '../components/footer.php'; ?>
    <script src="<?= VARIAVEIS['DIR_JS'] ?>main.js"></script>
</body>
</html>