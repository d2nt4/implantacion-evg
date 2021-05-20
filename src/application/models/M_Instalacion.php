<?php
/**
 * M_Instalacion
 * 
 * Clase para realizar la instalación de la aplicación
 * 
 * @author Abraham Núñez Palos y Daniel Torres Galindo
 * @version demo
 */
class M_Instalacion extends CI_Model
{
	/**
	 * Guarda el valor de carga de la base de datos
	 * 
	 * @var undefined
	 *
	 */

	var $bd = null;

	/**
	 * __construct
	 *
	 *Carga la base de datos en la variable bd
	 * 
	 * @return void
	 */
	
	public function __construct()
	{
		parent::__construct();
		$this -> bd = $this -> load -> database('default',true);
	}
	
	/**
	 * tablas
	 *
	 * Crea las tablas en la base de datos , cuando realiza la instalación
	 * 
	 * @return void
	 */


	public function tablas()
	{
		$tabla = [];
		$tabla[0] = "CREATE TABLE Aplicaciones
				(
					idAplicacion tinyint unsigned primary key auto_increment,
					nombre varchar(60) not null unique,
					descripcion varchar(200) not null,
					url varchar(200) not null,
					icono varchar(200) not null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp
				)ENGINE=INNODB;";

		$tabla[1] = "CREATE TABLE Perfiles
				(
					idPerfil tinyint unsigned primary key auto_increment,
					nombre varchar(60) not null unique,
					descripcion varchar(200) not null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp
				)ENGINE=INNODB;";

		$tabla[2] = "CREATE TABLE Aplicaciones_Perfiles
				(
					idPerfil tinyint unsigned,
					idAplicacion tinyint unsigned,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint PK_Aplicaciones_Perfiles primary key (idPerfil, idAplicacion),
					constraint FK_Aplicaciones_Perfiles_Perfiles 
						foreign key (idPerfil) 
							references Perfiles (idPerfil) 
								on delete cascade 
								on update cascade,
					constraint FK_Aplicaciones_Perfiles_Aplicaciones 
						foreign key (idAplicacion) 
							references Aplicaciones (idAplicacion) 
								on delete cascade 
								on update cascade
				)ENGINE=INNODB;";

		$tabla[3] = "CREATE TABLE Usuarios
				(
					idUsuario smallint unsigned primary key auto_increment,
					nombre varchar(60) not null,
					correo varchar(60) not null unique,
					bajaTemporal bit not null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp
				)ENGINE=INNODB;";

		$tabla[4] = "CREATE TABLE Perfiles_Usuarios
				(
					idPerfil tinyint unsigned,
					idUsuario smallint unsigned,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint PK_Perfiles_Usuarios primary key (idPerfil, idUsuario),
					constraint FK_Perfiles_Usuarios_Perfiles 
						foreign key (idPerfil) 
							references Perfiles (idPerfil) 
								on delete cascade 
								on update cascade,
					constraint FK_Perfiles_Usuarios_Usuarios 
						foreign key (idUsuario) 
							references Usuarios (idUsuario) 
								on delete cascade 
								on update cascade
				)ENGINE=INNODB;";

		$tabla[5] = "CREATE TABLE Etapas
				(
					idEtapa tinyint unsigned primary key auto_increment,
					codEtapa char(5) not null unique,
					nombre varchar(40) not null unique,
					idCoordinador smallint unsigned null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint FK_Etapas_Usuarios 
						foreign key (idCoordinador) 
							references Usuarios (idUsuario) 
								on delete set null 
								on update cascade
				)ENGINE=INNODB;";

		$tabla[6] = "CREATE TABLE Subetapas
				(
					idEtapa tinyint unsigned,
					idEtapaPadre tinyint unsigned,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint PK_Subetapas primary key (idEtapa, idEtapaPadre),
					constraint FK_Subetapas_Etapas
						foreign key (idEtapa) 
							references Etapas (idEtapa) 
								on delete cascade 
								on update cascade,
					constraint FK_Subetapas_EtapasPadre
						foreign key (idEtapaPadre) 
							references Etapas (idEtapa) 
								on delete cascade
								on update cascade
				)ENGINE=INNODB;";

		$tabla[7] = "CREATE TABLE Cursos
				(
					idCurso tinyint unsigned primary key auto_increment,
					codCurso char(5) not null unique,
					idCursoColegio char(5) null unique,
					nombre varchar(70) not null unique,
					idEtapa tinyint unsigned null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint FK_Cursos_Etapas
						foreign key (idEtapa) 
							references Etapas (idEtapa) 
								on delete set null 
								on update cascade
				)ENGINE=INNODB;";

		$tabla[8] = "CREATE TABLE FP_Departamentos
				(
					idDepartamento tinyint unsigned primary key auto_increment,
					nombre varchar(40) not null unique,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp
				)ENGINE=INNODB;";

		$tabla[9] = "CREATE TABLE FP_FamiliasProfesionales
				(
					idFamilia tinyint unsigned primary key auto_increment,
					nombre varchar(40) not null unique,
					idDepartamento tinyint unsigned null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint FK_FP_FamiliasProfesionales_FP_Departamentos
						foreign key (idDepartamento) 
							references FP_Departamentos (idDepartamento) 
								on delete set null
								on update cascade
				)ENGINE=INNODB;";

		$tabla[10] = "CREATE TABLE FP_Ciclos
				(
					idCiclo tinyint unsigned primary key auto_increment,
					codCiclo char(4) not null unique,
					nombre varchar(40) not null unique,
					idFamilia tinyint unsigned null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint FK_FP_Ciclos_FP_FamiliasProfesionales
						foreign key (idFamilia)
							references FP_FamiliasProfesionales (idFamilia) 
								on delete set null 
								on update cascade
				)ENGINE=INNODB;";

		$tabla[11] = "CREATE TABLE FP_Ciclos_Cursos
				(
					idCiclo tinyint unsigned,
					idCurso tinyint unsigned, 
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint PK_FP_Ciclos_Cursos primary key (idCiclo, idCurso),
					constraint FK_FP_Ciclos_Cursos_FP_Ciclos
						foreign key (idCiclo)
							references FP_Ciclos (idCiclo) 
								on delete cascade 
								on update cascade,
					constraint FK_FP_Ciclos_Cursos_Cursos
						foreign key (idCurso)
							references Cursos (idCurso) 
								on delete cascade 
								on update cascade
				)ENGINE=INNODB;";

		$tabla[12] = "CREATE TABLE Secciones
				(
					idSeccion smallint unsigned primary key auto_increment,
					codSeccion char(8) not null unique,
					idSeccionColegio char(8) null unique,
					nombre varchar(100) not null,
					idTutor smallint unsigned null unique,
					idCurso tinyint unsigned null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint FK_Secciones_Usuarios
						foreign key (idTutor)
							references Usuarios (idUsuario) 
								on delete set null 
								on update cascade,
					constraint FK_Secciones_Cursos
						foreign key (idCurso)
							references Cursos (idCurso) 
								on delete set null 
								on update cascade
				)ENGINE=INNODB;";

		$tabla[13] = "CREATE TABLE Alumnos
				(
					idAlumno int unsigned primary key auto_increment,
					NIA int unsigned not null unique,
					nombre varchar(60) not null,
					idSeccion smallint unsigned not null,
					correo varchar(60) null,
					sexo enum('m','f') not null,
					telefono char(9) not null,
					created_at timestamp default current_timestamp not null,
					updated_at timestamp default current_timestamp not null on update current_timestamp,
					constraint FK_Alumnos_Secciones
						foreign key (idSeccion)
							references Secciones (idSeccion) 
								on delete cascade 
								on update cascade
				)ENGINE=INNODB;";

		for($i = 0; $i < 14; $i++)
			$this -> bd -> query($tabla[$i]);

	}


}

?>
