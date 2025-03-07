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
?>

<body class="content">
    <?php
    // Inclui a barra de navegação
    require_once '../components/navbar.php';

    // Inclui a barra lateral
    require_once '../components/sidebar.php';
    ?>

    <main class="content-grid">
        <h1>Usuários</h1>
        <!-- Link para cadastrar nova categoria -->
        <a href="cadastro_usuario.php" class="btn">
            <button type="button">
                <span>
                    Novo Usuario
                </span>
                <span class="material-symbols-outlined">
                    add
                </span>
            </button>
        </a>
        <!-- Tabela de Usuários -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>CPF</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Acessa o array de usuários da sessão
                $usuarios = $_SESSION['usuarios'];

                // Exibe os usuários na tabela
                foreach ($usuarios as $usuario) {
                    echo "
                    <tr>
                        <td>{$usuario['id']}</td>
                        <td>{$usuario['nome']}</td>
                        <td>{$usuario['email']}</td>
                        <td>{$usuario['telefone']}</td>
                        <td>{$usuario['data_nascimento']}</td>
                        <td>{$usuario['cpf']}</td>
                        <td>
                            <a href='edicao_usuario.php?id={$usuario['id']}'>
                                <button type='button'>
                                    <span class='material-symbols-outlined'>edit</span>
                                </button>
                            </a>
                            <a href='excluir_usuario.php?id={$usuario['id']}' class='btn-excluir'>
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