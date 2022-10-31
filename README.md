<p align='right'>
  <img src='https://img.shields.io/badge/Versión-1.0.0-blue?style=flat-square' />
  <img src='https://img.shields.io/badge/Estatus-Terminado-green?style=flat-square' />
</p>

<h1> Agenda Telefónica Back-End </h1>
<p> Api desarrollada con PHP y MySQL para una Agenda Telefónica. </p>
<br>

<h2> Agenda Telefónica Front-End </h2>
<p> Para que el proyecto funcione tienes que tener la parte del Front-End ejecutandose en el servidor: </p>
<a href="https://github.com/UriLP/agenda_telefonica" target="_blank" >Agenda Telefonica Front-End</a>
<br><br>
<p> Ahí puedes encontrar más instrucciones para iniciar el servidor y ver el funcionamiento. </p>
<br>

<h2> Instalación </h2>
<p> Despues de clonar el repositorio localmente dentro de tu carpeta "htdocs" de "xampp" asegurate de haber instalado los paquetes de composer con el comando: </p>

```bash
composer install
```
<br>

<h3> Configurar el URL de la Base de Datos en el archivo .env </h3>
<p> En este archivo debes cambiar la palabra "root" por el nombre de usuario que usas para entrar a MySQL o si tambien usas "root" como nombre de usuario asi lo puedes dejar. </p>

<p> Si usas contraseña no olvides ponerla! </p>

<p>
  <img src="https://user-images.githubusercontent.com/98054611/198916062-c87e259c-6211-44ab-b9c1-d7ff46334921.png" width="1000" alt="DataBaseURL" />
</p>

<p> En caso de que uses otra Base de Datos puedes descomentar alguna de las que estan abajo y comentar la de MySQL, no olvides configurarla. </p>
<br>

<h2> XAMPP </h2>
<p> Asegurate de prender en el servidor de xampp los campos de "Apache" y "MySQL" para poder usar los siguietes comandos. </p>

<p>
  <img src="https://user-images.githubusercontent.com/98054611/198922603-0588e6d3-23a4-47b3-b518-3fcfab6712be.png" width="500" alt="xampp" />
</p>

<br>

<h3> Crear la Base de Datos </h3>
<p> Desde la consola dentro del proyecto usa los siguientes comandos: </p>

```bash
php bin/console doctrine:database:create

```
<br>

<h3> Migraciones </h3>
<p> Para crear las Tablas de la Base de Datos tenemos que crear las "migraciones", primero revisa si ya tienes algun archivo .php en la carpeta "migrations" y si es así puedes eliminarlo ya que crearemos uno nuevo con el siguiente comando: </p>

```bash
php bin/console make:migration
```
<p> Si te sale algún tipo de error puedes borrar la Base de Datos manualmente y volver a crearla con el comando anterior a este. </p>
<br>

<p> Ahora si podemos crear las Tablas en la Base de Datos con el comando: </p>

```bash
php bin/console doctrine:migrations:migrate
```

<p> Listo! Ya puedes ver las tablas creadas en tu Base de Datos :)
<br> <br>

<h2> Iniciar el Servidor </h2>
<p> Usando el siguiente comando podrás ver la página por defecto de Symfony en tu Navegador: </p>

```bash
php -S localhost:8000 -t public
```
<br>

<p>
  <img src="https://user-images.githubusercontent.com/98054611/198918768-6220971a-b4c4-4abf-85cf-fb9f88208d83.png" width="1000" alt="Symfony" />
</p>

<br>

<p> Puedes cambiar la url de tu navegador agregandole "api/contactos" y podrás ver algo como la siguiente imagen en formato "JSON" en caso de que ya tengas registros en tu Base de Datos, en caso contrario verás el arreglo vacio pero eso significa que todo funciona bien. </p>

<p>
  <img src="https://user-images.githubusercontent.com/98054611/198918343-08bae5ed-a03d-44b5-a48f-d77b620c2449.jpeg" width="1000" alt="Datos" />
</p>

<br>

<p> No es necesario que tengas esa página abierta para empezar a hacer pruebas en la parte del Front-End. </p>

<br>

<h2> Conclusión </h2>

<p> Resumiendo un poco, una vez tengas el servidor funcionando ya puedes abrir en el navegador el otro proyecto y realizar registros. 
  <li> La tabla "contacto" cuenta con los campos para: 
    <ul> 
      <li> Nombre </li>
      <li> Apellidos </li>
      <li> Número de Télefono </li>
      <li> Dirección </li>
      <li> Correo Electrónico </li>
    </ul>
    
  </li>
  <li> En la tabla "otros_numeros" solo se registra el id y el nuevo número. </li>
  <li> La relación entre estas dos tablas se realiza mediante el id en la tabla "contacto_otros_numeros". </li>
  <li> En el proyecto puedes encontrar un archivo con el nombre "comandos_usados.txt" donde puedes encontrar todos los comandos que fueron usados en el desarrollo de la API con un comentario de su función.
  <li> Symfony Versión 6.1 </li>
  <li> PHP Versión 8.1 </li>
</p>

<br>

<p> Si encuentras algún bug hazmelo saber para darle solución lo más pronto posible o si tienes alguna duda con respecto al proyecto no dudes en contactarme! :) </p>

<br>

Programado con ❤️ por [UriLP](https://github.com/UriLP)
