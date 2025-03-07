<?php
session_start(); // Inicia a sessão

// Inclui o arquivo de configuração do ambiente
require_once '../../config/env.php';

// Inclui o modelo UsuarioModel
require_once '../../model/UsuarioModel.php';

// Verifica se a sessão de usuários já existe
if (!isset($_SESSION['usuarios'])) {
    // Se não existir, inicializa com os dados do UsuarioModel
    $_SESSION['usuarios'] = UsuarioModel::$usuarios;
}

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o índice do usuário no array da sessão
    $indice = null;
    foreach ($_SESSION['usuarios'] as $key => $usuario) {
        if ($usuario['id'] == $id) {
            $indice = $key;
            break;
        }
    }

    // Remove o usuário do array na sessão
    if ($indice !== null) {
        array_splice($_SESSION['usuarios'], $indice, 1);
    }
}

// Redireciona de volta para a página de usuários
header('Location: usuarios.php');
exit;
?>