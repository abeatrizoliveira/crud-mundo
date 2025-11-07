<?php
include 'conexao.php';

$sqlPais = "SELECT id_pais, nm_pais FROM pais ORDER BY nm_pais ";
$resultPais = $mysqli->query($sqlPais);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id_cidade, nm_cidade, qtd_populacao, cd_pais FROM cidade WHERE id_cidade = '$id'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $cidade = $result->fetch_assoc();
        $nome = $cidade['nm_cidade'];
        $populacao = $cidade['qtd_populacao'];
        $pais = $cidade['cd_pais'];
        $idCidade = $cidade['id_cidade'];
    } else {
        echo "País não encontrado!";
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $populacao = $_POST['populacao'];
    $pais = $_POST['pais'];
    $idCidade = $_POST['id'];

    $sql = "UPDATE cidade SET nm_cidade='$nome', qtd_populacao='$populacao', cd_pais=$pais WHERE id_cidade=$idCidade";

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

            <form action="editaCidade.php" method="POST" class="form">
                <fieldset>
                    <legend>‎EDITAR CIDADE</legend>

                    <input type="hidden" name="id" value="<?php echo $idCidade; ?>">
                    <input type="text" name="nome" value="<?php echo $cidade['nm_cidade']; ?>" required>
                    <input type="number" name="populacao" min="0" value="<?php echo $cidade['qtd_populacao']; ?>">
                    <select name="pais" required>
                        <option value="">Selecione um país</option>
                        <?php
                        if ($resultPais->num_rows > 0) {
                            while ($linha = $resultPais->fetch_assoc()) {
                                echo '<option value="' . $linha['id_pais'] . '">' . $linha['nm_pais'] . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhum país disponível</option>';
                        }
                        ?>
                    </select>
                    <input type="submit" value="Atualizar Dados" class="btn-enviar">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>