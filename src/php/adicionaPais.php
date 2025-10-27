<?php
include 'conexao.php';

$nome = $_POST['nome'];
$populacao = $_POST['populacao'];
$idioma = $_POST['idioma'];
$continente = $_POST['continente'];

$sql = "INSERT INTO pais (nm_pais, qtd_populacao, nm_idioma, cd_continente) VALUES ('$nome', $populacao, '$idioma', $continente)";
if ($mysqli->query($sql) === TRUE) {
    header("Location: ../crud.php");
} else {
    echo "Erro: " . $sql . "<br>" . $mysqli->error;
}