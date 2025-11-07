<?php
include 'php/conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT cidade.id_cidade, cidade.nm_cidade, cidade.qtd_populacao, pais.nm_pais FROM cidade INNER JOIN pais ON cidade.cd_pais = pais.id_pais WHERE cidade.id_cidade = $id";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $cidade = $result->fetch_assoc();
        $nome = $cidade['nm_cidade'];
        $populacao = $cidade['qtd_populacao'];
        $pais = $cidade['nm_pais'];
        $idcidade = $cidade['id_cidade'];
    } else {
        echo "Cidade não encontrado!";
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media-query.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_back_ios,delete,edit" />
    <link rel="shortcut icon" href="./assets/images/globe-solid.svg" type="image/svg">
    <script src="https://kit.fontawesome.com/ccf50dfefd.js" crossorigin="anonymous"></script>
    <title><?php echo $nome; ?> - Mundo</title>
</head>

<body>
    <div class="cidade-content">
        <div class="estrelas"></div>
        <a href="index.php" class="btn-voltar" title="Voltar">
            <span class="material-symbols-outlined">
                arrow_back_ios
            </span>
        </a>
        <div class="cidade-container" data-codigo="<?= $codigo ?>">
            <div class="cidade">
                <div class="textos">
                    <h2><?php echo $nome; ?> | <?php echo $pais; ?></h2>
                    <p><strong>População:</strong> <?php echo number_format($populacao); ?></p>
                </div>
                <div class="cidade-weather" data-codigo="<?= $nome ?>">
                    <div class="textos centro">
                        <h2 class="situacao"></h2>
                        <img class="icone-clima" src="" alt="">
                        <div class="info">
                            <h2 class="temperatura"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/script.js"></script>
</body>

</html>