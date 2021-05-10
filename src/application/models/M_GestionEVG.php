<?php

class M_GestionEVG extends CI_Model
{
	var $bd = null;

	public function __construct()
	{
		parent::__construct();
		$this -> bd = $this -> load -> database('default',true);
	}


	public function insertar($tabla,$datos)
	{
		if($this -> bd -> insert($tabla,$datos))
			return $this -> bd -> insert_id();
		else
			echo $this -> bd -> error();
	}

	public function borrar($tabla,$id,$nombreId)
	{
		$this -> bd -> delete($tabla,array($nombreId => $id));
	}

	public function borrarCompuesta($tabla,$id1,$id2,$nombreId1,$nombreId2)
	{
		$this -> bd -> delete($tabla,array($nombreId1 => $id1, $nombreId2 => $id2));
	}

	public function modificar($tabla,$datos,$id,$nombreId)
	{
		foreach($datos as $indice => $valor)
			$this -> bd -> set($indice, $valor);
		$this -> bd -> where($nombreId, $id);
		$this -> bd -> update($tabla);
	}

	public function seleccionar($tabla, $campos, $condicion = null,$tabla_relacion = null, $relacion = null, $tipo_relacion = ['join'], $ordenacion = null)
	{
		$this -> bd -> select($campos);
		$this -> bd -> from($tabla);
		if(isset($relacion) && isset($tabla_relacion) && sizeof($tabla_relacion) == sizeof($relacion) && sizeof($tabla_relacion) == sizeof($tipo_relacion))
			for($i = 0; $i < sizeof($tabla_relacion); $i++)
				$this -> bd -> join($tabla_relacion[$i],$relacion[$i],$tipo_relacion[$i]);
		if(isset($condicion))
			$this -> bd -> where($condicion);
		if(isset($ordenacion))
			$this -> bd -> order_by($ordenacion);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function buscar($tabla, $valor, $campo)
	{
		$this -> bd -> select($campo);
		$this -> bd -> from($tabla);
		$this -> bd -> where($campo."='".$valor."'");
		$query = $this -> bd->get();
		$rows = $query -> num_rows();
		$query -> free_result();
		return $rows;
	}

	public function obtenerIdUsuario($correo)
	{
		$this -> bd -> select('idUsuario');
		$this -> bd -> from('Usuarios');
		$this -> bd -> where('correo='.$this->bd->escape($correo));
		$query = $this -> bd -> get();
		if($query -> num_rows() > 0) 
		{
			$rows = $query -> result_array();
			$idUsuario = $rows[0]['idUsuario'];
		}
		else
			return false;
		$query -> free_result();
		return $idUsuario;
	}

	/*APLICACIONES*/

	/*public function seleccionarApps()
	{
		$this -> bd -> select('idAplicacion, nombre');
		$this -> bd -> from('Aplicaciones');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function datosApp($idAplicacion)
	{
		$this -> bd -> select('nombre, descripcion, url, icono');
		$this -> bd -> from('Aplicaciones');
		$this -> bd -> where('idAplicacion='.$idAplicacion);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*public function cogerPerfilesAplicacion($idAplicacion)
	{
		$this -> bd -> select('p.idPerfil, p.nombre');
		$this -> bd -> from('Perfiles p');
		$this -> bd -> join('Aplicaciones_Perfiles ap','p.idPerfil = ap.idPerfil');
		$this -> bd -> where('ap.idAplicacion='.$idAplicacion);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*
SELECT p.idPerfil, p.nombre
FROM perfiles p
INNER JOIN aplicaciones_perfiles ap
ON p.idPerfil=ap.idPerfil
WHERE ap.idAplicacion=12;
	*/

	/*public function cogerPerfilesNoAplicacion($idAplicacion)
	{
		$this -> bd -> select('p.idPerfil, p.nombre');
		$this -> bd -> from('Perfiles p');
		$this -> bd -> where('p.idPerfil NOT IN (SELECT ap2.idPerfil FROM Aplicaciones_Perfiles ap2 WHERE ap2.idAplicacion='.$idAplicacion.')');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

/*
SELECT p.idPerfil, p.nombre
FROM perfiles p
INNER JOIN aplicaciones_perfiles ap
ON p.idPerfil=ap.idPerfil
WHERE
*/

	/*PERFILES*/

	/*public function seleccionarPerfiles()
	{
		$this -> bd -> select('idPerfil, nombre');
		$this -> bd -> from('Perfiles');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*public function datosPerfil($idPerfil)
	{
		$this -> bd -> select('nombre, descripcion');
		$this -> bd -> from('Perfiles');
		$this -> bd -> where('idPerfil='.$idPerfil);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function cogerUsuariosPerfil($idPerfil)
	{
		$this -> bd -> select('u.idUsuario, u.correo');
		$this -> bd -> from('Usuarios u');
		$this -> bd -> join('Perfiles_Usuarios pu','pu.idUsuario = u.idUsuario');
		$this -> bd -> where('pu.idPerfil='.$idPerfil);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/
/*
SELECT u.idUsuario, u.correo
FROM usuarios u
INNER JOIN perfiles_usuarios pu
ON pu.idUsuario=u.idUsuario
WHERE pu.idPerfil=5
*/

	

	/*USUARIOS

	public function seleccionarUsuarios()
	{
		$this -> bd -> select('idUsuario, correo');
		$this -> bd -> from('Usuarios');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function datosUsuario($idUsuario)
	{
		$this -> bd -> select('nombre, correo, bajaTemporal');
		$this -> bd -> from('Usuarios');
		$this -> bd -> where('idUsuario='.$idUsuario);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*ETAPAS*/

	/*public function seleccionarEtapas()
	{
		$this -> bd -> select('idEtapa, codEtapa');
		$this -> bd -> from('Etapas');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function cogerUsuarios()
	{
		$this -> bd -> select('idUsuario, correo');
		$this -> bd -> from('Usuarios');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}



	public function datosEtapa($idEtapa)
	{
		$this -> bd -> select('codEtapa, nombre, idCoordinador');
		$this -> bd -> from('Etapas');
		$this -> bd -> where('idEtapa='.$idEtapa);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*public function cogerEtapasPadre($idEtapa)
	{
		$this -> bd -> select('E.codEtapa, s.idEtapaPadre, E2.codEtapa');
		$this -> bd -> from('Etapas E');
		$this -> bd -> join('Subetapas S','E.idEtapa = S.idEtapa');
		$this -> bd -> join('Etapas E2','S.idEtapaPadre=E2.idEtapa');
		$this -> bd -> where('E.idEtapa='.$idEtapa);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*
SELECT s.idEtapaPadre, e2.codEtapa
FROM etapas e
INNER JOIN subetapas s
ON e.idEtapa = s.idEtapa
INNER JOIN etapas e2
ON s.idEtapaPadre=e2.idEtapa
WHERE e.idEtapa=8*/

	/*public function cogerEtapasNoPadre($idEtapa)
	{
		$this -> bd -> select('e.idEtapa, e.codEtapa');
		$this -> bd -> from('Etapas e');
		$this -> bd -> join('Subetapas s','e.idEtapa = s.idEtapa','left');
		$this -> bd -> where('e.idEtapa!='.$idEtapa.' AND e.idEtapa NOT IN (SELECT S2.idEtapaPadre FROM Etapas e2 INNER JOIN Subetapas s2 ON e2.idEtapa = s2.idEtapa WHERE e2.idEtapa='.$idEtapa.' )');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/
	/*
SELECT *
FROM etapas e
LEFT JOIN subetapas s
ON e.idEtapa = s.idEtapa
WHERE e.idEtapa != 8 AND e.idEtapa NOT IN (

SELECT s2.idEtapaPadre
FROM etapas e2
INNER JOIN subetapas s2
ON e2.idEtapa = s2.idEtapa
WHERE e2.idEtapa=8
)*/

	/*CURSOS*/

	/*public function seleccionarCursos()
	{
		$this -> bd -> select('idCurso, codCurso');
		$this -> bd -> from('Cursos');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function datosCurso($idCurso)
	{
		$this -> bd -> select('idCursoColegio, codCurso, nombre, idEtapa');
		$this -> bd -> select('idCursoColegio, codCurso, nombre, idEtapa');
		$this -> bd -> from('Cursos');
		$this -> bd -> where('idCurso='.$idCurso);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function cogerEtapas()
	{
		$this -> bd -> select('idEtapa, codEtapa');
		$this -> bd -> from('Etapas');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/


	/*DEPARTAMENTOS*/

	/*public function seleccionarDepartamentos()
	{
		$this -> bd -> select('idDepartamento, nombre');
		$this -> bd -> from('FP_Departamentos');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function datosDepartamento($idDepartamento)
	{
		$this -> bd -> select('nombre');
		$this -> bd -> from('FP_Departamentos');
		$this -> bd -> where('idDepartamento='.$idDepartamento);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*FAMILIAS PROFESIONALES*/

	/*public function seleccionarFamilias()
	{
		$this -> bd -> select('idFamilia, nombre');
		$this -> bd -> from('FP_FamiliasProfesionales');
		$query = $this -> bd->get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function cogerDepartamentos()
	{
		$this -> bd -> select('idDepartamento, nombre');
		$this -> bd -> from('FP_Departamentos');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function datosFamilia($idFamilia)
	{
		$this -> bd -> select('idFamilia, nombre, idDepartamento');
		$this -> bd -> from('FP_FamiliasProfesionales');
		$this -> bd -> where('idFamilia='.$idFamilia);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*CICLOS*/

	/*public function seleccionarCiclos()
	{
		$this -> bd -> select('idCiclo, codCiclo');
		$this -> bd -> from('FP_Ciclos');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function cogerFamilias()
	{
		$this -> bd -> select('idFamilia, nombre');
		$this -> bd -> from('FP_FamiliasProfesionales');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function datosCiclo($idCiclo)
	{
		$this -> bd -> select('idCiclo, codCiclo, nombre, idFamilia');
		$this -> bd -> from('FP_Ciclos');
		$this -> bd -> where('idCiclo='.$idCiclo);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*public function cogerCursosCiclo($idCiclo)
	{
		$this -> bd -> select('cu.idCurso, cu.codCurso');
		$this -> bd -> from('Cursos cu');
		$this -> bd -> join('FP_Ciclos_Cursos cc','cu.idCurso = cc.idCurso');
		$this -> bd -> where('cc.idCiclo='.$idCiclo);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*public function cogerCursosNoCiclo($idCiclo)
	{
		$this -> bd -> select('cu.idCurso, cu.codCurso');
		$this -> bd -> from('Cursos cu');
		$this -> bd -> where('cu.idCurso NOT IN (SELECT cc2.idCurso FROM FP_Ciclos_Cursos cc2 WHERE cc2.idCiclo='.$idCiclo.')');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*SECCIONES*/

	/*public function seleccionarSecciones()
	{
		$this -> bd -> select('idSeccion, codSeccion');
		$this -> bd -> from('Secciones');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function cogerCursos()
	{
		$this -> bd -> select('idCurso, codCurso');
		$this -> bd -> from('Cursos');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function datosSeccion($idSeccion)
	{
		$this -> bd -> select('idSeccion, idSeccionColegio, codSeccion, nombre, idCurso');
		$this -> bd -> from('Secciones');
		$this -> bd -> where('idSeccion='.$idSeccion);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*public function cogerProfesores()
	{
		$this -> bd -> select('idUsuario, correo');
		$this -> bd -> from('Usuarios');
		$this -> bd -> where("idUsuario IN (SELECT idUsuario FROM Perfiles_Usuarios WHERE idPerfil=( SELECT idPerfil FROM Perfiles WHERE nombre='profesor')AND idUsuario NOT IN (SELECT idUsuario FROM Perfiles_Usuarios WHERE idPerfil=(SELECT idPerfil FROM Perfiles WHERE nombre='tutor')))");
		$this -> bd -> order_by('correo');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

/*
SELECT idUsuario, correo
FROM usuarios
WHERE idUsuario IN (
	SELECT idUsuario
    FROM perfiles_usuarios
    WHERE idPerfil=(
    	SELECT idPerfil
        FROM perfiles
        WHERE nombre='profesor'
    ) AND idUsuario NOT IN (
    	SELECT idUsuario
        FROM perfiles_usuarios
        WHERE idPerfil=(
            SELECT idPerfil
            FROM perfiles
            WHERE nombre='tutor'
        )
    )
)
*/

	/*public function idPerfilTutor()
	{
		$this -> bd -> select('idPerfil');
		$this -> bd -> from('Perfiles');
		$this -> bd -> where("nombre='tutor'");
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

	public function idTutorSeccion($idSeccion)
	{
		$this -> bd -> select('idTutor');
		$this -> bd -> from('Secciones');
		$this -> bd -> where("idSeccion=".$idSeccion);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

	/*public function seleccionarSeccionesEtapa($idEtapa)
	{
		$this -> bd -> select('s.idSeccion, s.codSeccion');
		$this -> bd -> from('Secciones s');
		$this -> bd -> join('Cursos c','s.idCurso=c.idCurso');
		$this -> bd -> join('Etapas e','c.idEtapa=e.idEtapa');
		$this -> bd -> where("e.idEtapa",$idEtapa);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/



/*
SELECT s.idSeccion, s.codSeccion
FROM secciones s
INNER JOIN cursos c
ON s.idCurso=c.idCurso
INNER JOIN etapas e
ON c.idEtapa=e.idEtapa
WHERE e.idEtapa=14
*/

	/*LISTADO DE TUTORES*/

	/*public function listadoTutores()
	{
		$this -> bd -> select('S.codSeccion, U.correo');
		$this -> bd -> from('Secciones s');
		$this -> bd -> join('Usuarios u','s.idTutor=u.idUsuario','left');
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/


	/*select S.codSeccion, U.nombre
from secciones s left join usuarios u
on s.idTutor=u.idUsuario */


/*	public function aplicacionesPermitidas($idUsuario)
	{
		$this -> bd -> select('distinct(a.url), a.nombre, a.icono');
		$this -> bd -> from('Aplicaciones a');
		$this -> bd -> join('Aplicaciones_Perfiles ap','a.idAplicacion= ap.idAplicacion');
		$this -> bd -> join('Perfiles_Usuarios pu','pu.idPerfil=ap.idPerfil');
		$this -> bd -> where("idUsuario=",$idUsuario);
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}

/*
select distinct a.idAplicacion, a.nombre
from Aplicaciones a
inner join Aplicaciones_Perfiles ap
on a.idAplicacion= ap.idAplicacion
inner join Perfiles_Usuarios pu
on pu.idPerfil=ap.idPerfil
where idUsuario=2;
*/

	/*public function buscarUsuarios($idPerfil, $valor)
	{
		$this -> bd -> select('*');
		$this -> bd -> from('Usuarios');
		$this -> bd -> where("idUsuario NOT IN(
			SELECT idUsuario
			FROM Perfiles_Usuarios
			WHERE idPerfil=".$idPerfil."
		) AND correo LIKE ('%".$valor."%')");
		$query = $this -> bd -> get();
		$rows = $query -> result_array();
		$query -> free_result();
		return $rows;
	}*/

/*
SELECT *
FROM usuarios
WHERE idUsuario NOT IN (
	SELECT idUsuario
    FROM perfiles_usuarios
    WHERE idPerfil=1
) AND correo LIKE('%us%')
*/
}

?>
