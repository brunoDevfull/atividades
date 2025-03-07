<?php
session_start(); // Inicia a sessão

// Inclui o arquivo de configuração do ambiente
require_once '../../config/env.php';

// Inclui o modelo ArtigosModel
require_once '../../model/ArtigosModel.php';

// Verifica se a sessão de artigos já existe
if (!isset($_SESSION['artigo'])) {
    // Se não existir, inicializa com os dados do ArtigosModel
    $_SESSION['artigo'] = ArtigosModel::$artigo;
}

// Verifica se o ID do artigo foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o índice do artigo no array da sessão
    $indice = null;
    foreach ($_SESSION['artigo'] as $key => $artigo) {
        if ($artigo['id'] == $id) {
            $indice = $key;
            break;
        }
    }

    // Remove o artigo do array na sessão
    if ($indice !== null) {
        array_splice($_SESSION['artigo'], $indice, 1);
    }
}

// Redireciona de volta para a página de artigos
header('Location: artigos.php');
exit;
?>