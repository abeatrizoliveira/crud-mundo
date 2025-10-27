create database mundo;
use mundo;

create table continente(
    id_continente int primary key auto_increment,
    nm_continente varchar(50) not null
);

create table pais(
    id_pais int primary key auto_increment,
    nm_pais varchar(50) not null,
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