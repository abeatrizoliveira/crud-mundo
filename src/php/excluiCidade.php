<?php
include 'conexao.php';
$idCidade = $_GET['id'];

$queryExcluir = "DELETE FROM cidade WHERE id_cidade = $idCidade;";
mysqli_query($mysqli, $queryExcluir);

if (mysqli_affected_rows($mysqli) > 0) {
    header('Location: ../crud.php');
    exit();
} else {
    echo "Erro ao excluir o país.";
}
