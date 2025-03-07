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
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];

    // Gera um novo ID para o usuário
    $novoId = 1; // Valor inicial
    if (!empty($_SESSION['usuarios'])) {
        // Encontra o maior ID existente
        $maiorId = max(array_column($_SESSION['usuarios'], 'id'));
        $novoId = $maiorId + 1; // Novo ID é o maior ID + 1
    }


    // Cria o novo usuário
    $novoUsuario = [
        'id' => $novoId,
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'data_nascimento' => $data_nascimento,
        'cpf' => $cpf
    ];

    // Adiciona o novo usuário ao array na sessão
    array_push($_SESSION['usuarios'], $novoUsuario);

    // Redireciona de volta para a página de usuários
    header('Location: usuarios.php');
    exit;
}
?>

<body class="content">
    <?php require_once '../components/navbar.php'; ?>
    <?php require_once '../components/sidebar.php'; ?>
    <main class="content-grid">
        <h1>Cadastro de Usuário</h1>
        <form method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" required>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>

            <button type="submit">Salvar</button>
        </form>
    </main>
    <?php require_once '../components/footer.php'; ?>
    <script src="<?= VARIAVEIS['DIR_JS'] ?>main.js"></script>
</body>
</html>