-- Borramos las etapas existentes e introducimos las etapas que usaremos.
DELETE FROM Etapas;

INSERT INTO
    Etapas (idEtapa, codEtapa, nombre)
VALUES
    (1, 'BACH', 'Bachillerato'),
    (2, 'CFGS', 'Ciclos Formativos de Grado Superior'),
    (3, 'CFGM', 'Ciclos Formativos de Grado Medio'),
    (4, 'ESO', 'Educación Secundaria Obligatoria'),
    (5, 'EP', 'Educación Primaria'),
    (6, 'EI', 'Educación Infatil')
;

-- Borramos los cursos existentes e introducimos los que usaremos.
DELETE FROM Cursos;

INSERT INTO
    Cursos (idCurso, codCurso, nombre, idEtapa)
VALUES
    (1, '1BC', '1º de Bachillerato', 1),
    (2, '1DAW', '1º F.P.E.G.S.(Desarrollo de Aplicaciones Web)', 2),
    (3, '2DAW', '2º F.P.E.G.S.(Desarrollo de Aplicaciones Web)(LOE)', 2),
    (4, '1EMV', '1º F.P.E.G.M.(Electromecánica de Vehículos Automóviles)(LOE)', 3),
    (5, '2EMV', '2º F.P.E.G.M.(Electromecánica de Vehículos Automóviles)(LOE)', 3),
    (6, '1ESO', '1º E.S.O.', 4),
    (7, '2ESO', '2º E.S.O.', 4),
    (8, '3ESO', '3º E.S.O.', 4),
    (9, '4ESO', '4º E.S.O.', 4),
    (10, '1GA', '1º F.P.E.G.M.(Gestión Administrativa)(LOE)', 3),
    (11, '2GA', '2º F.P.E.G.M.(Gestión Administrativa)(LOE)', 3),
    (12, '1ME', '1º F.P.E.G.M.(Mantenimiento Electromecánico)(LOE)', 3),
    (13, '2ME', '2º F.P.E.G.M.(Mantenimiento Electromecánico)(LOE)', 3),
    (14, '1MI', '1º F.P.E.G.S.(Mecatrónica Industrial)(LOE)', 2),
    (15, '2MI', '2º F.P.E.G.S.(Mecatrónica Industrial)(LOE)', 2),
    (16, '1SMR', '1º F.P.E.G.M. (Sistemas Microinformáticos y Redes)(LOE)', 3),
    (17, '2SMR', '2º F.P.E.G.M. (Sistemas Microinformáticos y Redes)(LOE)', 3),
    (18, '1º EI', 'Tres Años', 6),
    (19, '1º EP', '1º de Educación Primaria', 5),
    (20, '2º EI', 'Cuatro Años', 6),
    (21, '2º EP', '2º de Educación Primaria', 5),
    (22, '2B', '2º de Bachillerato', 1),
    (23, '3º EI', 'Cinco Años', 6),
    (24, '3º EP', '3º de Educación Primaria', 5),
    (25, '4º EP', '4º de Educación Primaria', 5),
    (26, '5º EP', '5º de Educación Primaria', 5),
    (27, '6º EP', '6º de Educación Primaria', 5)
;

-- Asignamos cursos a secciones.
UPDATE Secciones SET idCurso=1 WHERE codSeccion LIKE 'BC1_'; -- 1º Bachillerato
UPDATE Secciones SET idCurso=2 WHERE codSeccion='DAW1'; -- DAW1
UPDATE Secciones SET idCurso=3 WHERE codSeccion='DAW2'; -- DAW2
UPDATE Secciones SET idCurso=4 WHERE codSeccion='EMV1'; -- EMV1
UPDATE Secciones SET idCurso=5 WHERE codSeccion='EMV2'; -- EMV2
UPDATE Secciones SET idCurso=6 WHERE codSeccion LIKE 'ES1_'; -- ES1
UPDATE Secciones SET idCurso=7 WHERE codSeccion LIKE 'ES2_'; -- ES2
UPDATE Secciones SET idCurso=8 WHERE codSeccion LIKE 'ES3_'; -- ES3
UPDATE Secciones SET idCurso=9 WHERE codSeccion LIKE 'ES4_'; -- ES4
UPDATE Secciones SET idCurso=10 WHERE codSeccion='GA1'; -- GA1
UPDATE Secciones SET idCurso=11 WHERE codSeccion='GA2'; -- GA2
UPDATE Secciones SET idCurso=12 WHERE codSeccion='ME1'; -- ME1
UPDATE Secciones SET idCurso=13 WHERE codSeccion='ME2'; -- ME2
UPDATE Secciones SET idCurso=14 WHERE codSeccion='MI1'; -- MI1
UPDATE Secciones SET idCurso=15 WHERE codSeccion='MI2'; -- MI2
UPDATE Secciones SET idCurso=16 WHERE codSeccion='SMR1'; -- SMR1
UPDATE Secciones SET idCurso=17 WHERE codSeccion='SMR2'; -- SMR2
UPDATE Secciones SET idCurso=18 WHERE codSeccion LIKE '1º EI _'; -- 1º EI
UPDATE Secciones SET idCurso=19 WHERE codSeccion LIKE '1º EP _'; -- 1º EP
UPDATE Secciones SET idCurso=20 WHERE codSeccion LIKE '2º EI _'; -- 2º EI
UPDATE Secciones SET idCurso=21 WHERE codSeccion LIKE '2º EP _'; -- 2º EP
UPDATE Secciones SET idCurso=22 WHERE codSeccion LIKE '2B%'; -- 2B
UPDATE Secciones SET idCurso=23 WHERE codSeccion LIKE '3º EI _'; -- 3º EI
UPDATE Secciones SET idCurso=24 WHERE codSeccion LIKE '3º EP _'; -- 3º EP
UPDATE Secciones SET idCurso=25 WHERE codSeccion LIKE '4º EP _'; -- 4º EP
UPDATE Secciones SET idCurso=26 WHERE codSeccion LIKE '5º EP _'; -- 5º EP
UPDATE Secciones SET idCurso=27 WHERE codSeccion LIKE '6º EP _'; -- 6º EP