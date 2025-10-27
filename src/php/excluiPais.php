<?php
include 'conexao.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID do país não fornecido.']);
    exit();
}

$idPais = (int)$_GET['id']; // força inteiro por segurança
$queryExcluir = "DELETE FROM pais WHERE id_pais = $idPais;";

if (mysqli_query($mysqli, $queryExcluir)) {
    if (mysqli_affected_rows($mysqli) > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nenhum país encontrado para excluir.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Erro no banco de dados.']);
}
?>
