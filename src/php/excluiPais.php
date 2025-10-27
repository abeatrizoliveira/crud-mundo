<?php
include 'conexao.php';
$idPais = $_GET['id'];

$queryExcluir = "DELETE FROM pais WHERE id_pais = $idPais;";
mysqli_query($mysqli, $queryExcluir);  

if (mysqli_affected_rows($mysqli) > 0) {
    header('Location: ../crud.php');
    exit();
} else {
    echo "Erro ao excluir o país.";
}