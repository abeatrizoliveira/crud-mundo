<?php
include 'conexao.php';

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$populacao = $_POST['populacao'];
$idioma = $_POST['idioma'];
$continente = $_POST['continente'];

$sql = "INSERT INTO pais (nm_pais, cd_pais, qtd_populacao, nm_idioma, cd_continente) VALUES ('$nome',$codigo , $populacao, '$idioma', $continente)";
if ($mysqli->query($sql) === TRUE) {
    header("Location: ../crud.php");
} else {
    echo "Erro: " . $sql . "<br>" . $mysqli->error;
}
