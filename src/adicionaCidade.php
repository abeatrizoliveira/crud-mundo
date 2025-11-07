<?php
include 'php/conexao.php';
$sql = "SELECT id_pais, nm_pais FROM pais ORDER BY nm_pais ";
$result = $mysqli->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/media-query.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=keyboard_arrow_left,keyboard_arrow_right " />
    <link rel="shortcut icon" href="../assets/images/globe-solid.svg" type="image/svg">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_back_ios" />
    <script src="https://kit.fontawesome.com/ccf50dfefd.js" crossorigin="anonymous"></script>
    <title>Mundo</title>
</head>

<body>
    <div class="content">
        <a href="crud.php" class="btn-voltar" title="Voltar">
            <span class="material-symbols-outlined">
                arrow_back_ios
            </span>
        </a>
        <div class="container-form">
            <div class="globe-form"></div> <!-- Globo atrás -->
            <form action="php/adicionaCidade.php" method="post" class="form">
                <fieldset>
                    <legend>‎ CADASTRAR CIDADES ‎</legend>
                    <input type="text" name="nome" placeholder="Digite o nome da cidade" required>
                    <input type="number" name="populacao" min="0" placeholder="Digite o número da população">
                    <select name="pais" required>
                        <option value="">Selecione um país</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="' . $row['id_pais'] . '">' . $row['nm_pais'] . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhum país disponível</option>';
                        }
                        ?>
                    </select>
                    <input type="submit" value="Adicionar País" class="btn-enviar">
                </fieldset>
            </form>
        </div>

    </div>
</body>

</html>