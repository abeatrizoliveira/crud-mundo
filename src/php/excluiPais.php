<?php
include 'conexao.php';
header('Content-Type: application/json');

// Frufrus aplicados por conta da api de alerta em javascript (exige esses fatores para que ela consiga enviar a menmsagem para o usuário de acordo com o resultado aqui)

if (!isset($_GET['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID do país não fornecido.']);
    exit();
}

$idPais = (int)$_GET['id'];

$queryExcluir = "DELETE FROM pais WHERE id_pais = $idPais;";

if (mysqli_query($mysqli, $queryExcluir)) {
    if (mysqli_affected_rows($mysqli) > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nenhum país encontrado para excluir.']);
    }
} else {
    // Captura o erro real do MySQL (por exemplo, violação de FK)
    $erro = mysqli_error($mysqli);
    echo json_encode(['success' => false, 'message' => "Erro ao excluir: $erro"]);
}
