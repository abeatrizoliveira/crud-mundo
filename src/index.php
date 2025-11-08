<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/media-query.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=keyboard_arrow_left,keyboard_arrow_right " />
  <link rel="shortcut icon" href="./assets/images/globe-solid.svg" type="image/svg">
  <script src="https://kit.fontawesome.com/ccf50dfefd.js" crossorigin="anonymous"></script>
  <title>Mundo</title>
</head>

<body>
  <!-- Menu para telas grandes -->
  <nav class="menu hidden">
    <i class="fa-solid fa-globe"></i>
    <ul>
      <li><a href="#home">Início</a></li>
      <li><a href="#sobre">Sobre</a></li>
      <li><a href="#paises" class="link">Países</a></li>
      <li><a href="#cidades" class="link">Cidades</a></li>
      <li><a href="crud.php" class="link">Crud</a></li>
    </ul>
  </nav>

  <!-- Banner da tela inicial -->
  <div class="banner" id="home">
    <div class="estrelas"></div>
    <div class="banner-content">
      <div class="globe"></div>
      <div class="banner-text">
        <h1>TERRA</h1>
      </div>
      <span>"Seu planeta, sua casa, seu lar."</span>
    </div>
  </div>
  <!-- Sobre nosso planeta -->
  <div class="sobre" id="sobre">
    <div class="left">
      <h2>O PLANETA TERRA</h2>
      <p>A Terra é um planeta cheio de diversidade, com paisagens naturais, cidades movimentadas e diferentes culturas. Aqui você encontra oceanos, florestas, desertos e montanhas, além de uma grande variedade de espécies e modos de vida. Seja explorando lugares tranquilos ou centros urbanos, sempre há algo novo para descobrir.
        <br> <br> Aproveite e conheça os países e cidades do nosso planeta!
      </p>
    </div>
    <div class="right">
      <img src="./assets/images/imagensTerra.png" alt="Imagens de lugares do planeta Terra" cl>
    </div>
  </div>

  <div class="paises" id="paises">
    <h1>PAÍSES</h1>
    <div class="container-carrossel">
      <button class="btn-left"><span class="material-symbols-outlined">keyboard_arrow_left</span></button>
      <div class="carrossel">
        <?php
        include 'php/conexao.php';
        $sql = "SELECT pais.id_pais, pais.nm_pais, pais.cd_pais,  continente.nm_continente FROM pais INNER JOIN continente ON pais.cd_continente = continente.id_continente";
        $result = $mysqli->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>
          <a href="pais.php?id=<?= $row['id_pais'] ?>">
            <div class="card" data-codigo="<?= $row['cd_pais'] ?>">
              <div class="bandeira"></div>
              <div class="textos">
                <h3><?= $row['nm_pais'] ?> - <span class="sigla"></span></h3>
                <p><?= $row['nm_continente'] ?></p>
              </div>
            </div>
          </a>
        <?php } ?>
      </div>

      <button class="btn-right"><span class="material-symbols-outlined">keyboard_arrow_right</span></button>
    </div>
  </div>
  <div class="cidades" id="cidades">
    <div class="textos">
      <h1>CIDADES</h1>
      <p>As cidades são centros de convivência humana onde se concentram cultura, comércio e serviços. Reúnem diversidade social, oportunidades e inovação, ao mesmo tempo em que enfrentam desafios como mobilidade, moradia e sustentabilidade. Conhecer uma cidade é conhecer suas histórias, arquiteturas e a vida cotidiana de quem a habita.</p>
    </div>
    <div class="container-carrossel-cidades">
      <button class="btn-left-cidades"><span class="material-symbols-outlined">keyboard_arrow_left</span></button>
      <div class="carrossel-cidades">
        <?php
        include 'php/conexao.php';
        $sql = "SELECT cidade.id_cidade, cidade.nm_cidade, pais.nm_pais FROM cidade INNER JOIN pais ON cidade.cd_pais = pais.id_pais";
        $result = $mysqli->query($sql);

        while ($row = $result->fetch_assoc()) {
        ?>
          <a href="cidade.php?id=<?= $row['id_cidade'] ?>">
            <div class="card">
              <div class="card-textos">
                <h3><?= $row['nm_cidade'] ?></h3>
                <p>(<?= $row['nm_pais'] ?>)</p>
              </div>
            </div>
          </a>
        <?php } ?>
      </div>

      <button class="btn-right-cidades"><span class="material-symbols-outlined">keyboard_arrow_right</span></button>
    </div>
  </div>
  <footer>
    <p>Você chegou ao final do site!</p>
    <span>Desenvolvido por Beatriz</span>
    <div class="footer-icons">
      <a href="https://github.com/abeatrizoliveira">
        <i class="fa-brands fa-square-github"></i>
      </a>
      <a href="https://www.linkedin.com/in/beatriz-oliveira2007/">
        <i class="fa-brands fa-linkedin"></i>
      </a>
    </div>
  </footer>

  <script src="js/script.js"></script>

</body>

</html>