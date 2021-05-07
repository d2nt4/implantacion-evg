DELETE FROM
    Aplicaciones
WHERE
    nombre='AppProfesores'
    OR url='https://google.com'
    OR nombre='GestionDatosFCT'
    OR url='https://w3schools.com'
;

INSERT INTO
    Aplicaciones (nombre, descripcion, url, icono)
VALUES 
    ('AppProfesores', 'Aplicación profesores', 'https://google.com', 'profesor.png'),
    ('GestionDatosFCT', 'Gestión de datos de FCT', 'https://w3schools.com', 'fct.jpg')
;

DELETE FROM
    Perfiles
WHERE
    nombre='CoordinadorFCT'
    OR nombre='Perfil2'
;

INSERT INTO
    Perfiles (nombre, descripcion)
VALUES 
    ('CoordinadorFCT', 'Coordinador de FCT'),
    ('Perfil2', 'perfil 2')
;

DELETE FROM
    Usuarios
WHERE
    correo='usuario1@evg.es'
;

INSERT INTO
    Usuarios (nombre, correo)
VALUES
    ('usuario1', 'usuario1@evg.es')
;

DELETE FROM
    Etapas
WHERE
    codEtapa='BACH'
    OR codEtapa='CFGS'
    OR nombre='bachillerato'
    OR nombre='ciclos'
;

INSERT INTO
    Etapas (codEtapa, nombre)
VALUES 
    ('BACH1', 'bachillerato1'),
    ('BACH2', 'bachillerato2'),
    ('BACH', 'bachillerato')
;

DELETE FROM
    FP_Departamentos
WHERE
    idDepartamento=1
    OR idDepartamento=2
;

INSERT INTO
    FP_Departamentos (idDepartamento, nombre)
VALUES 
    (1, 'informática'),
    (2, 'administración')
;

DELETE FROM
    FP_FamiliasProfesionales
WHERE
    idFamilia=1
    OR nombre='tecnología'
;

INSERT INTO
    FP_FamiliasProfesionales (idFamilia, nombre, idDepartamento)
VALUES
    (1, 'tecnología', 1)
;

DELETE FROM
    FP_Ciclos
WHERE
    codCiclo='DAW'
    OR codCiclo='MI'
;

INSERT INTO
    FP_Ciclos (codCiclo, nombre, idFamilia)
VALUES
    ('DAW', 'desarrollo de aplicaciones web', 1),
    ('MI', 'mecatrónica industrial', 1)
;