<?php
include 'php/conexao.php';

$queryPaises = "SELECT
    pais.id_pais,
    pais.nm_pais,
    pais.qtd_populacao,
    pais.nm_idioma,
    continente.nm_continente
FROM pais
INNER JOIN continente ON pais.cd_continente = continente.id_continente;";

$resultPaises = mysqli_query($mysqli, $queryPaises);

$queryCidades = "SELECT 
    cidade.id_cidade,
    cidade.nm_cidade,
    cidade.qtd_populacao,
    pais.nm_pais
FROM cidade
INNER JOIN pais ON cidade.cd_pais = pais.id_pais;";

$resultCidades = mysqli_query($mysqli, $queryCidades);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_back_ios,delete,edit" />
    <link rel="shortcut icon" href="./assets/images/globe-solid.svg" type="image/svg">
    <script src="https://kit.fontawesome.com/ccf50dfefd.js" crossorigin="anonymous"></script>
    <title>CRUD - Mundo</title>
</head>
<body>
    <div class="content-crud">
        <div class="estrelas"></div>
        <a href="index.html" class="btn-voltar" title="Voltar">
            <span class="material-symbols-outlined">
                arrow_back_ios
            </span>
        </a>
        <div class="container-crud">
            <div class="titulo">
                <span>PAÍSES</span>
                <a href="adicionaPais.html"><button class="btn-adicionar">Adicionar</button></a>
            </div>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Continente</th>
                    <th>População</th>
                    <th>Idioma</th>
                    <th>Ações</th>

                </tr>
                <?php while ($pais = mysqli_fetch_assoc($resultPaises)) { ?>
                <tr>
                    <td><?= $pais['id_pais'] ?></td>
                    <td><?= $pais['nm_pais'] ?></td>
                    <td><?= $pais['nm_continente'] ?></td>
                    <td><?= $pais['qtd_populacao'] ?></td>
                    <td><?= $pais['nm_idioma'] ?></td>
                    <td>
                        <a href="php/editaPais.php?id=<?= $pais['id_pais'] ?>"><span class="material-symbols-outlined" title="Editar">edit</span></a>
                        <a href="php/excluiPais.php?id=<?= $pais['id_pais'] ?>"><span class="material-symbols-outlined" title="Excluir">delete</span></a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <div class="dados">
                <p>Total de países:</p>
                <?php echo "0".mysqli_num_rows($resultPaises)?>
            </div>
            
            <div class="titulo">
                <span>CIDADES</span>
                <a href="adicionaCidade.php"><button class="btn-adicionar">Adicionar</button></a>
            </div>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>País</th>
                    <th>População</th>
                    <th>Ações</th>
                </tr>
                <?php while ($cidade = mysqli_fetch_assoc($resultCidades)) { ?>
                <tr>
                    <td><?= $cidade['id_cidade'] ?></td>
                    <td><?= $cidade['nm_cidade'] ?></td>
                    <td><?= $cidade['nm_pais'] ?></td>
                    <td><?= $cidade['qtd_populacao'] ?></td>
                     <td>
                        <a href="php/editaCidade.php?id=<?= $cidade['id_cidade'] ?>"><span class="material-symbols-outlined" title="Editar">edit</span></a>
                        <a href="php/excluiCidade.php?id=<?= $cidade['id_cidade'] ?>"><span class="material-symbols-outlined" title="Excluir">delete</span></a>
                    </td>
                </tr>
                <?php } ?>
            </table>
            <div class="dados">
                <p>Total de cidades:</p>
                <?php echo "0".mysqli_num_rows($resultCidades   )?>
            </div>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($mysqli);
?>