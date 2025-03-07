<?php
session_start(); // Inicia a sessão

// Inclui o arquivo de configuração do ambiente
require_once '../../config/env.php';

// Inclui o cabeçalho da página
require_once '../components/head.php';

// Inclui o modelo UsuarioModel
require_once '../../model/UsuarioModel.php';

// Verifica se a sessão de usuários já existe
if (!isset($_SESSION['usuarios'])) {
    // Se não existir, inicializa com os dados do UsuarioModel
    $_SESSION['usuarios'] = UsuarioModel::$usuarios;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];

    // Busca o usuário no array da sessão
    foreach ($_SESSION['usuarios'] as &$usuario) {
        if ($usuario['id'] == $id) {
            // Atualiza os dados do usuário
            $usuario['nome'] = $nome;
            $usuario['email'] = $email;
            $usuario['telefone'] = $telefone;
            $usuario['data_nascimento'] = $data_nascimento;
            $usuario['cpf'] = $cpf;
            break;
        }
    }

    // Redireciona de volta para a página de usuários
    header('Location: usuarios.php');
    exit;
}

// Recupera o ID do usuário da URL
$id = $_GET['id'] ?? null;

// Busca o usuário correspondente no array da sessão
$usuario = null;
foreach ($_SESSION['usuarios'] as $item) {
    if ($item['id'] == $id) {
        $usuario = $item;
        break;
    }
}
?>

<body class="content">
    <?php require_once '../components/navbar.php'; ?>
    <?php require_once '../components/sidebar.php'; ?>
    <main class="content-grid">
        <h1>Edição de Usuário</h1>
        <?php if ($usuario) : ?>
            <form method="POST" action="">
                <!-- Campo oculto para enviar o ID do usuário -->
                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= $usuario['nome'] ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $usuario['email'] ?>" required>

                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?= $usuario['telefone'] ?>" required>

                <label for="data_nascimento">Data de Nascimento:</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $usuario['data_nascimento'] ?>" required>

                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="<?= $usuario['cpf'] ?>" required>

                <button type="submit">Salvar</button>
            </form>
        <?php else : ?>
            <p>Usuário não encontrado.</p>
        <?php endif; ?>
    </main>
    <?php require_once '../components/footer.php'; ?>
    <script src="<?= VARIAVEIS['DIR_JS'] ?>main.js"></script>
</body>
</html>