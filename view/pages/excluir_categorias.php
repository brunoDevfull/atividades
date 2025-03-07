<?php
session_start();

// Inclui o arquivo de configuração do ambiente
require_once '../../config/env.php';

// Inclui o modelo CategoriasModel
require_once '../../model/CategoriasModel.php';

// Verifica se a sessão de categorias já existe
if (!isset($_SESSION['categorias'])) {
    // Se não existir, inicializa com os dados do ArtigosModel
    $_SESSION['categorias'] = CategoriasModel::$categorias;
}

// Verifica se o ID da categorias foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o índice da categorias no array da sessão
    $indice = null;
    foreach ($_SESSION['categorias'] as $key => $categorias) {
        if ($categorias['id'] == $id) {
            $indice = $key;
            break;
        }
    }

    // Remove a categorias do array na sessão
    if ($indice !== null) {
        array_splice($_SESSION['categorias'], $indice, 1);
    }
}

// Redireciona de volta para a página de categorias
header('Location: categorias.php');
exit;
?>