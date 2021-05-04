DELETE FROM aplicaciones WHERE nombre='AppProfesores' OR url='https://google.com' OR nombre='GestionDatosFCT' OR url='https://w3schools.com' ;
INSERT INTO aplicaciones (nombre, descripcion, url, icono) VALUES 
('AppProfesores', 'Aplicación profesores', 'https://google.com', 'profesor.png'),
('GestionDatosFCT', 'Gestión de datos de FCT', 'https://w3schools.com', 'fct.jpg');

DELETE FROM perfiles WHERE nombre='CoordinadorFCT' OR nombre='Perfil2';
INSERT INTO perfiles (nombre, descripcion) VALUES 
('CoordinadorFCT', 'Coordinador de FCT'),
('Perfil2', 'perfil 2');

DELETE FROM usuarios WHERE correo='usuario1@evg.es';
INSERT INTO usuarios (nombre, correo) VALUES ('usuario1', 'usuario1@evg.es');

DELETE FROM etapas WHERE codEtapa='BACH' OR codEtapa='CFGS' OR nombre='bachillerato' OR nombre='ciclos';
INSERT INTO etapas (codEtapa, nombre) VALUES 
('BACH1', 'bachillerato1'),
('BACH2', 'bachillerato2'),
('BACH', 'bachillerato');

DELETE FROM fp_departamentos WHERE idDepartamento=1 OR idDepartamento=2;
INSERT INTO fp_departamentos (idDepartamento, nombre) VALUES 
(1, 'informática'),
(2, 'administración');

DELETE FROM fp_familiasprofesionales WHERE idFamilia=1 OR nombre='tecnología';
INSERT INTO fp_familiasprofesionales (idFamilia, nombre, idDepartamento) VALUES (1, 'tecnología', 1);

DELETE FROM fp_ciclos WHERE codCiclo='DAW' OR codCiclo='MI';
INSERT INTO fp_ciclos (codCiclo, nombre, idFamilia) VALUES
('DAW', 'desarrollo de aplicaciones web', 1),
('MI', 'mecatrónica industrial', 1);