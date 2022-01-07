-- CREACIÓN DE TABLAS QUIZ_HP --

create table preguntas (
cod_p int not null,
texto_p char(200),
tipo char(1),
musica char(100),
constraint pk_preguntas primary key (cod_p)
);

create table respuestas (
cod_r int not null,
cod_p int not null,
texto_r char(100),
constraint pk_respuestas primary key (cod_r),
constraint fk_respuestas foreign key (cod_p) references preguntas (cod_p)
);

create table correctas (
cod_p int not null,
cod_r int not null,
constraint pk_correctas primary key (cod_p)
);

create table jugadores (
cod_j int auto_increment not null,
fecha date not null,
nombre char(100),
avatar char(100),
puntuacion integer,
constraint pk_jugadores primary key (cod_j)
);

-- INSERCIÓN PREGUNTAS Y RESPUESTAS --
insert into preguntas values (1, 'La piedra filosofal aparece en Harry Potter y las Reliquias de la Muerte II', 'b', 'harry8');
insert into respuestas values (1, 1, 'Verdadero');
insert into respuestas values (2, 1, 'Falso');
insert into correctas values (1, 2);

insert into preguntas values (2, '¿Quién soy?-imagenes/kingsley.jpg', 'c', 'harry7');
insert into respuestas values (3, 2, 'Mandangus Fletcher');
insert into respuestas values (4, 2, 'Kingsley Shacklebolt');
insert into correctas values (2, 4);

insert into preguntas values (3, '¿Cuál de estos no es un ingrediente de la poción multijugos?', 'a', 'harry2');
insert into respuestas values (5, 3, 'Polvo de cuerno de bicornio');
insert into respuestas values (6, 3, 'Piel de serpiente arbórea africana');
insert into respuestas values (7, 3, 'Cascabel de serpiente');
insert into respuestas values (8, 3, 'ADN de la persona en la que se quiere convertir');
insert into correctas values (3, 7);

insert into preguntas values (4, '¿Qué especie de dragón soy?-imagenes/norberto.jpg', 'c', 'harry1');
insert into respuestas values (9, 4, 'Ridgeback Noruego');
insert into respuestas values (10, 4, 'Verde galés común');
insert into correctas values (4, 9);

insert into preguntas values (5, '¿De qué película es este fotograma?-imagenes/frame_peli_5.jpg', 'c', 'harry5');
insert into respuestas values (11, 5, 'Harry Potter y el Misterio del Principe');
insert into respuestas values (12, 5, 'Harry Potter y la Orden del Fénix');
insert into correctas values (5, 12);

insert into preguntas values (6, 'El patronus de Hermione Granger es un gato', 'b', 'harry3');
insert into respuestas values (13, 6, 'Falso');
insert into respuestas values (14, 6, 'Verdadero');
insert into correctas values (6, 13);

insert into preguntas values (7, 'Nymphadora Tonks hace su primera aparición en Harry Potter y el Misterio del Príncipe', 'b', 'harry6');
insert into respuestas values (15, 7, 'Verdadero');
insert into respuestas values (16, 7, 'Falso');
insert into correctas values (7, 16);

insert into preguntas values (8, '¿Cuántos hermanos tiene Ronald Weasley?', 'a', 'harry2');
insert into respuestas values (17, 8, '5');
insert into respuestas values (18, 8, '6');
insert into respuestas values (19, 8, '4');
insert into respuestas values (20, 8, '7');
insert into correctas values (8, 18);

insert into preguntas values (9, '¿Qué objeto utilizan de traslador para viajar a los mundiales de Quidditch en la cuarta película?', 'a', 'harry4');
insert into respuestas values (21, 9, 'Una bota');
insert into respuestas values (22, 9, 'La Copa de Campeones');
insert into respuestas values (23, 9, 'El Sombrero Seleccionador');
insert into respuestas values (24, 9, 'Una escoba de Quidditch');
insert into correctas values (9, 21);

insert into preguntas values (10, '¿Qué hechizo utiliza la profesora McGonagall para proteger el castillo en Harry Potter y las Reliquias de la muerte Parte II?', 'a', 'harry8');
insert into respuestas values (25, 10, 'Arresto Momentum');
insert into respuestas values (26, 10, 'Protego');
insert into respuestas values (27, 10, 'Expecto Patronum');
insert into respuestas values (28, 10, 'Piertotum Locomotor');
insert into correctas values (10, 28);

insert into jugadores (fecha, nombre, avatar, puntuacion) values ('2021-08-20', 'parry_potter', 'imagenes/harry.jpg', 150);
insert into jugadores (fecha, nombre, avatar, puntuacion) values ('2021-08-20', 'luna_loveGOD', 'imagenes/luna.jpg', 200);
insert into jugadores (fecha, nombre, avatar, puntuacion) values ('2021-08-20', 'ron_cola', 'imagenes/ron.jpg', 50);
insert into jugadores (fecha, nombre, avatar, puntuacion) values ('2021-08-20', 'nick_decapitado', 'imagenes/dobby.jpg', 250);
insert into jugadores (fecha, nombre, avatar, puntuacion) values ('2021-08-20', 'voldy_fiesta', 'imagenes/voldemort.jpg', 0);

select * from preguntas;
select * from respuestas;
select * from correctas;
select * from jugadores;



