# Implantación Aplicaciones - Escuela Virgen de Guadalupe 2020/2021

## Autores
#### Daniel Torres Galindo y Abraham Núñez Palos

## Framework
#### CodeIgniter versión 3

## Licencia
#### [GNU General Public License 3.0](https://www.gnu.org/licenses/gpl-3.0.html)

## Descripción
#### Repositorio para la implantación y despliegue de las aplicaciones de la Escuela Virgen de Guadalupe.

## Instalación
### Requisitos previos
#### -> Descargar aplicación del repositorio.
```bash
git clone https://github.com/danitorres24/implantacion-evg.git
```
#### ->Configurar url base en el archivo de config.php
```bash
$config['base_url'] = 'Url base de la aplicacion';
```
#### -> Configurar los datos de la base de datos que se encuentra en el archivo de database.php.
```bash
$db['default'] = array
(
	'dsn'	=> '',
	'hostname' => 'url del servidor de base de datos',
	'username' => 'usuario de la base de datos',
	'password' => 'contraseña del usuario',
	'database' => 'nombre de la base de datos',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```
#### -> Subir aplicación al hosting, en el directorio public_html/<aplicación>
#### -> Crear y configurar archivo .htaccess según los criterios deseados para la aplicación. Debe crearse en el directorio public_html.

### Como haceder a la instalación
```bash
base_url/C_Instalacion
```
