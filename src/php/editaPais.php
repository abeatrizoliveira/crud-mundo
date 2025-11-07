<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id_pais, nm_pais, cd_pais, qtd_populacao, nm_idioma, cd_continente FROM pais WHERE id_pais = '$id'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $pais = $result->fetch_assoc();
        $nome = $pais['nm_pais'];
        $codigo = $pais['cd_pais'];
        $populacao = $pais['qtd_populacao'];
        $idioma = $pais['nm_idioma'];
        $continente = $pais['cd_continente'];
        $idPais = $pais['id_pais'];
    } else {
        echo "País não encontrado!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $codigo = $_POST['codigo'];
    $populacao = $_POST['populacao'];
    $idioma = $_POST['idioma'];
    $continente = $_POST['continente'];
    $idPais = $_POST['id'];

    $sql = "UPDATE pais SET nm_pais='$nome', cd_pais='$codigo', qtd_populacao='$populacao', nm_idioma='$idioma', cd_continente=$continente WHERE id_pais=$idPais";

    if ($mysqli->query($sql) === TRUE) {
        echo "Registro atualizado com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $mysqli->error;
    }

    $mysqli->close();

    header("Location: ../crud.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/media-query.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=keyboard_arrow_left,keyboard_arrow_right " />
    <link rel="shortcut icon" href="../assets/images/globe-solid.svg" type="image/svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_back_ios" />
    <script src="https://kit.fontawesome.com/ccf50dfefd.js" crossorigin="anonymous"></script>
    <title>Mundo</title>
</head>

<body>
    <div class="content">
        <a href="../crud.php" class="btn-voltar" title="Voltar">
            <span class="material-symbols-outlined">arrow_back_ios</span>
        </a>
        <div class="container-form">
            <div class="globe-form"></div>

            <form action="editaPais.php" method="POST" class="form">
                <fieldset>
                    <legend>‎EDITAR PAÍS‎</legend>

                    <input type="hidden" name="id" value="<?php echo $idPais; ?>">
                    <input type="text" name="nome" value="<?php echo $pais['nm_pais']; ?>" required>
                    <input type="number" name="codigo" min="01" max="999" value="<?php echo $pais['cd_pais']; ?>">
                    <input type="number" name="populacao" min="0" value="<?php echo $pais['qtd_populacao']; ?>">
                    <input type="text" name="idioma" value="<?php echo $pais['nm_idioma']; ?>">

                    <select name="continente" required>
                        <option value="">Selecione um continente</option>
                        <option value="1" <?php if ($continente == 1) echo "selected"; ?>>África</option>
                        <option value="2" <?php if ($continente == 2) echo "selected"; ?>>América</option>
                        <option value="3" <?php if ($continente == 4) echo "selected"; ?>>Ásia</option>
                        <option value="4" <?php if ($continente == 5) echo "selected"; ?>>Europa</option>
                        <option value="5" <?php if ($continente == 6) echo "selected"; ?>>Oceania</option>
                    </select>
                    <input type="submit" value="Atualizar Dados" class="btn-enviar">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>