# Implantación Aplicaciones - EVG 2020/2021

<div align="center">
	<img src="/src/uploads/iconos/evg.png" alt="Logo EVG"/>
</div>

## Despliegue en Hosting :computer:
#### [ESVIRGUA](https://app.esvirgua.com/)

## Autores :man_technologist:
#### Daniel Torres Galindo y Abraham Núñez Palos

## Framework :hammer_and_wrench:
#### [CodeIgniter 3](https://www.codeigniter.com/userguide3/index.html)

## Licencia :copyright:
#### [GNU General Public License 3.0](https://www.gnu.org/licenses/gpl-3.0.html)

## Descripción :clipboard:
#### Repositorio para la implantación y despliegue de las aplicaciones de la Escuela Virgen de Guadalupe

## Instalación :floppy_disk:
### Requisitos previos
#### :small_blue_diamond:Hacer configuración del proyecto en [Google Cloud Platform](https://cloud.google.com/) :cloud:
#### :small_blue_diamond:Disponer de un Hosting Web o en su defecto configuración Localhost
#### :small_blue_diamond:Descargar aplicación de este repositorio por consola de git o bien en formato comprimido
```bash
git clone https://github.com/danitorres24/implantacion-evg.git
```
#### :small_blue_diamond:Configurar url base en el archivo de config.php
```bash
$config['base_url'] = 'Url base de la aplicacion'; Ejemplo: http://www.tu-app.com/
```
#### :small_blue_diamond:Configurar los datos de la base de datos que se encuentra en el archivo de database.php
```bash
$db['default'] = array
(
	'dsn'	=> '',
	'hostname' => '', Nombre del Host
	'port' => '', Puerto del Servidor de Base de Datos
	'username' => '', Nombre del Usuario de la Base de Datos
	'password' => '', Contraseña del Usuario de la Base de Datos
	'database' => '', Nombre de la Base de Datos
	'dbdriver' => '', Driver de la Base de Datos
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE, 
	'cachedir' => '',
	'char_set' => 'utf8', Charset de la Base de Datos
	'dbcollat' => 'utf8_general_ci', El conjunto de caracteres de la Base de Datos
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```
#### :small_blue_diamond:Subir aplicación a tu hosting, en el directorio public_html/carpeta-app
#### :small_blue_diamond:Crear y configurar archivo .htaccess según los criterios deseados para la aplicación. Debe crearse en el directorio public_html

### Como acceder a la instalación
```bash
base_url/C_Instalacion Ejemplo: https://www.tu-app-com/<carpeta-app>/C_Instalacion
```
