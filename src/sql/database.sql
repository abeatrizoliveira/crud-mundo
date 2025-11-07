create database bd_mundo;
use bd_mundo;

create table continente(
    id_continente int primary key auto_increment,
    nm_continente varchar(50) not null
);

create table pais(
    id_pais int primary key auto_increment,
    nm_pais varchar(50) not null,
    cd_pais varchar(3) not null,
    qtd_populacao bigint not null,
    nm_idioma varchar(50) not null,
    cd_continente int not null,
    foreign key (cd_continente) references continente(id_continente)
);  

create table cidade(
    id_cidade int primary key auto_increment,
    nm_cidade varchar(50) not null,
    qtd_populacao bigint not null,
    cd_pais int not null,
    foreign key (cd_pais) references pais(id_pais)
);

-- Inserção dos Continentes
insert into continente (nm_continente) values 
('África'),
('América'),
('Ásia'),
('Europa'),
('Oceania');

-- Inserção dos Países
INSERT INTO pais (nm_pais,cd_pais, nm_idioma, qtd_populacao, cd_continente) VALUES
('Brasil', 076, 'Português', 211695000, 2),
('Estados Unidos', 840, 'Inglês', 334914895, 2),
('China', 156, 'Mandarim', 1409670000, 3),
('Índia', 356, 'Hindi e Inglês', 1460000000, 3),
('Alemanha', 276, 'Alemão', 83000000, 4);

-- Brasil
INSERT INTO cidade (nm_cidade, qtd_populacao, cd_pais) VALUES
('São Paulo', 12400232, 1),
('Rio de Janeiro', 6747815, 1),
('Belo Horizonte', 2721564, 1),
('Salvador', 2711840, 1),
('Fortaleza', 2400000, 1);

-- Estados Unidos
INSERT INTO cidade (nm_cidade, qtd_populacao, cd_pais) VALUES
('Nova York', 7936530, 2),
('Los Angeles', 3770958, 2),
('Chicago', 2611867, 2),
('Houston', 2324082, 2),
('Phoenix', 1675144, 2);

-- China
INSERT INTO cidade (nm_cidade, qtd_populacao, cd_pais) VALUES
('Pequim',  21893000, 3),
('Xangai', 24870000, 3),
('Chongqing', 32000000, 3),
('Shenzhen', 17000000, 3),
('Guangzhou', 14498400, 3);

-- Índia
INSERT INTO cidade (nm_cidade, qtd_populacao, cd_pais) VALUES
('Mumbai',  12442000, 4),
('Delhi',  19800000, 4),
('Bengaluru', 13000000, 4),
('Hyderabad',  10000000, 4),
('Ahmedabad', 8000000, 4);

-- Alemanha
INSERT INTO cidade (nm_cidade, qtd_populacao, cd_pais) VALUES
('Berlim',  3769000, 5),
('Hamburgo',  1899000, 5),
('Munique',  1484000, 5),
('Colônia',  1080000, 5),
('Frankfurt',  763000, 5);
