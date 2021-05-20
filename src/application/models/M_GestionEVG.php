<?php
/**
 * M_GestionEVG
 * 
 * Clase para realizar la gestión de la aplicación
 * 
 * @author Abraham Núñez Palos y Daniel Torres Galindo
 * @version demo
 */

class M_GestionEVG extends CI_Model
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
	 * Carga la base de datos en la variable bd
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this -> bd = $this -> load -> database('default',true);
	}

	/**
	 * insertar
	 * 
	 * Función que permite insertar datos en la base de datos
	 * 
	 * @param string $tabla
	 * @param mixed $datos
	 * 
	 * @return void
	 */

	public function insertar($tabla,$datos)
	{
		if($this -> bd -> insert($tabla,$datos))
			return $this -> bd -> insert_id();
		else
			echo $this -> bd -> error();
	}

	/**
	 * borrar
	 * 
	 * Función que permite eliminar elemento por id
	 * 
	 * @param string $tabla
	 * @param mixed $id
	 * @param string $nombreId
	 * 
	 * @return void
	 */

	public function borrar($tabla,$id,$nombreId)
	{
		$this -> bd -> delete($tabla,array($nombreId => $id));
	}
	
	/**
	 * borrarCompuesta
	 * 
	 * Funcion que permite eliminar elemento con más de un id
	 *
	 * @param  string $tabla
	 * @param  mixed $id1
	 * @param  mixed $id2
	 * @param  string $nombreId1
	 * @param  string $nombreId2
	 * 
	 * @return void
	 */
	public function borrarCompuesta($tabla,$id1,$id2,$nombreId1,$nombreId2)
	{
		$this -> bd -> delete($tabla,array($nombreId1 => $id1, $nombreId2 => $id2));
	}
	
	/**
	 * modificar
	 * 
	 * Función que permite actualizar datos de la base de datos
	 *
	 * @param  string $tabla
	 * @param  mixed $datos
	 * @param  mixed $id
	 * @param  string $nombreId
	 * 
	 * @return void
	 */
	public function modificar($tabla,$datos,$id,$nombreId)
	{
		foreach($datos as $indice => $valor)
			$this -> bd -> set($indice, $valor);
		$this -> bd -> where($nombreId, $id);
		$this -> bd -> update($tabla);
	}
	
	/**
	 * seleccionar
	 * 
	 * Función que permite realizar consulta que recupera datos de la base de datos
	 *
	 * @param  string $tabla
	 * @param  string $campos
	 * @param  mixed $condicion
	 * @param  array|null $tabla_relacion
	 * @param  array|null $relacion
	 * @param  array $tipo_relacion
	 * @param  string $ordenacion
	 * 
	 * @return void
	 */
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
	
	/**
	 * obtenerIdUsuario
	 * 
	 * Función que permite obtener el id del usuario a partir de un correo
	 *
	 * @param  string $correo
	 * 
	 * @return void
	 */
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
}

?>
