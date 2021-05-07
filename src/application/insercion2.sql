-- Borramos las etapas existentes e introducimos las etapas que usaremos
DELETE FROM Etapas;
INSERT INTO Etapas (idEtapa, codEtapa, nombre) VALUES
(1, 'BACH', 'bachillerato'),
(2, 'CFGS', 'Ciclos Superiores'),
(3, 'CFGM', 'Ciclos Medios'),
(4, 'ESO', 'educación secundaria obligatoria'),
(5, 'EP', 'educación primaria'),
(6, 'EI', 'educación infatil');


-- Borramos los cursos existentes e introducimos los que usaremos
DELETE FROM Cursos;
INSERT INTO Cursos (idCurso, codCurso, nombre, idEtapa) VALUES
(1, 'BC1', '1º de Bachillerato', 1),
(2, 'DAW1', '1º F.P.E.G.S.(Desarrollo de Aplicaciones Web)', 2),
(3, 'DAW2', '2º F.P.E.G.S.(Desarrollo de Aplicaciones Web)(LOE)', 2),
(4, 'EMV1', '1º F.P.E.G.M.(Electromecánica de vehículos automóviles)(LOE)', 3),
(5, 'EMV2', '2º F.P.E.G.M.(Electromecánica de vehículos automóviles)(LOE)', 3),
(6, 'ES1', '1º E.S.O.', 4),
(7, 'ES2', '2º E.S.O.', 4),
(8, 'ES3', '3º E.S.O.', 4),
(9, 'ES4', '4º E.S.O.', 4),
(10, 'GA1', '1º F.P.E.G.M.(Gestión Administrativa)(LOE)', 3),
(11, 'GA2', '2º F.P.E.G.M.(Gestión Administrativa)(LOE)', 3),
(12, 'ME1', '1º F.P.E.G.M.(Mantenimiento Electromecánico)(LOE)', 3),
(13, 'ME2', '2º F.P.E.G.M.(Mantenimiento Electromecánico)(LOE)', 3),
(14, 'MI1', '1º F.P.E.G.S.(Mecatrónica Industrial)(LOE)', 2),
(15, 'MI2', '2º F.P.E.G.S.(Mecatrónica Industrial)(LOE)', 2),
(16, 'SMR1', '1º F.P.E.G.M. (Sistemas microinformáticos y redes)(LOE)', 3),
(17, 'SMR2', '2º F.P.E.G.M. (Sistemas microinformáticos y redes)(LOE)', 3),
(18, '1º EI', 'Tres Años', 6),
(19, '1º EP', '1º de Educación Primaria', 5),
(20, '2º EI', 'Cuatro Años', 6),
(21, '2º EP', '2º de Educación Primaria', 5),
(22, '2B', '2º de Bachillerato', 1),
(23, '3º EI', 'Cinco Años', 6),
(24, '3º EP', '3º de Educación Primaria', 5),
(25, '4º EP', '4º de Educación Primaria', 5),
(26, '5º EP', '5º de Educación Primaria', 5),
(27, '6º EP', '6º de Educación Primaria', 5);


-- Asignamos cursos a secciones
UPDATE Secciones SET idCurso=1 WHERE codSeccion LIKE 'BC1_'; -- primero bachillerato
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