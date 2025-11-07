<?php
include 'conexao.php';

$nome = $_POST['nome'];
$populacao = $_POST['populacao'];
$pais = $_POST['pais'];

$sql = "INSERT INTO cidade (nm_cidade, qtd_populacao, cd_pais) VALUES ('$nome', $populacao, $pais)";
if ($mysqli->query($sql) === TRUE) {
    header("Location: ../crud.php");
} else {
    echo "Erro: " . $sql . "<br>" . $mysqli->error;
}
