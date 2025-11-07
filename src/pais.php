<?php
include 'php/conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT pais.id_pais, pais.nm_pais, pais.cd_pais, pais.qtd_populacao, pais.nm_idioma, pais.cd_continente, continente.nm_continente FROM pais INNER JOIN continente ON pais.cd_continente = continente.id_continente WHERE pais.id_pais = $id";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $pais = $result->fetch_assoc();
        $nome = $pais['nm_pais'];
        $codigo = $pais['cd_pais'];
        $populacao = $pais['qtd_populacao'];
        $idioma = $pais['nm_idioma'];
        $continente = $pais['nm_continente'];
        $idPais = $pais['id_pais'];
    } else {
        echo "País não encontrado!";
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
    <div class="pais-content">
        <a href="index.php" class="btn-voltar" title="Voltar">
            <span class="material-symbols-outlined">
                arrow_back_ios
            </span>
        </a>
        <div class="pais-container" data-codigo="<?= $codigo ?>">
            <div class="pais">
                <div class="bandeira"></div>
                <div class="textos">
                    <h2 class="nome-oficial"></h2>
                    <p><strong>Continente:</strong> <?php echo $continente; ?></p>
                    <p><strong>Idioma:</strong> <?php echo $idioma; ?></p>
                </div>
            </div>
            <div class="pais-info">
                <div class="textos">
                    <h2>INFORMAÇÕES EXTRAS</h2>
                    <div class="infos">
                        <div class="info">
                            <p><strong>População:</strong> <?php echo number_format($populacao); ?></p>
                            <p><strong>Capital:</strong> <span class="capital"></span></p>
                        </div>
                        <div class="info">
                            <p><strong>Moeda:</strong> <span class="moeda-nome"></span> </p>
                            <p><strong>Símbolo da moeda:</strong> <span class="moeda"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pais-weather" data-codigo="<?= $nome ?>">
            <div class="menu">
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