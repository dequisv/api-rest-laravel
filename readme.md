# API RESTful con Laravel

## Sobre Laravel PHP Framework

Laravel es un framework para aplicaciones web con sintaxis expresiva y elegante. Creemos que el desarrollo debe ser una experiencia agradable y creativa para que sea verdaderamente enriquecedora. Laravel busca eliminar el sufrimiento del desarrollo facilitando las tareas comunes utilizadas en la mayoría de los proyectos web, como la autenticación, enrutamiendo, sesiones y almacenamiento en caché.

Laravel es un framework para el lenguaje de programación PHP. Aunque PHP es conocido por tener una sintaxis poco deseable, es fácil de usar, fácil de desplegar y se le puede encontrar en muchos de los sitios web modernos que usas día a día. 

Laravel no solo ofrece atajos útiles, herramientas y componentes para ayudarte a conseguir el éxito en tus proyectos basados en web, si no que también intenta arreglar alguna de las flaquezas de PHP.

Laravel tiene una sintaxis bonita, semántica y creativa, que le permite destacar entre la gran cantidad de frameworks disponibles para el lenguaje. Hace que PHP sea un placer, sin sacrificar potencia y eficiencia. Es sencillo de entender, permite mucho la modularidad de código lo cuál es bueno en la reutilización de código.

### Beneficios de Laravel

* Incluye un ORM(Eloquent): A diferencia de CodeIgniter, Laravel incluye un ORM integrado. Por lo cual no debes instalar absolutamente nada.
* Bundles: existen varios paquetes que extienden a Laravel y te dan funcionalidades increíbles..
* Programas de una forma elegante y eficiente: No más código basura o espaguetti que no se entienden, aprenderás a programar ‘con clase’ y ordenar tu código de manera de que sea lo más re-utilizable posible.
* Controlas la BD desde el código: Puedes tener un control de versiones de lo que haces con ella. A esto se llaman migrations, es una excelente herramienta, porque puedes manejar todo desde tu IDE, inclusive montar datos en tus tablas.
* Da soporte a PHP 5.3.
* Rutas elegantes y seguras: Una misma ruta puede responder de distinto modo a un método GET o POST.
* Cuenta con su propio motor de platillas HTML.
* Se actualiza facilmente desde la línea de comandos: El framework es actualizable utilizando composer update y listo, nada de descargar un ZIP y estar remplazando.
* Cuenta con una comunidad activa que da apoyo rápido al momento de que lo necesitas.

## Estructura de Proyecto Laravel
Los principales directorios que se crean en Laravel los puedes consultar en la [documentación oficial](https://laravel.com/docs/5.6/structure), a continuación, una breve explicación de los más importantes:

* app: contiene los modelos, y el código base de nuestra aplicación, incluirá los directorios Console, Http y Providers
* resources/views: contiene las Vistas.
* app/Http/Controllers: aquí será donde se definirán los controladores.
* app/Http/routes.php: para la definición de las rutas.
* app/config/app.php: contiene configuración general de la aplicación.
* public: carpeta pública desde dónde se inicia el proceso de ejecución de una aplicación Laravel.

## Entorno de Desarrollo
* XAMPP
* php 5.6
* Laravel 5.0
* MySQL 5.4
* Visual Studio Code

## Instalación
1. Instalar XAMPP
2. Instalar Composer

### Sobre Composer
Composer es una herramienta para administración de dependencias en PHP, permite declarar las librerías de las cuáles el proyecto depende o necesita y éste las instala en el proyecto.

Composer no es un administrador de paquetes. Sí, él trata con "paquetes" o "librerías", pero las gestiona en función de cada proyecto y no instala nada globalmente en el equipo, por lo cual solo administra las dependencias del mismo.

Composer usa un archivo dentro de tu proyecto de Laravel para poder administrar las dependencias el cual se llama: composer.json. Este usa un formato JSON.

## Configuración de Entorno
1. Configuración archivo hosts
```
127.0.0.1	api-rest
``` 
2. Crear VirtualHost
Modificar archivo httpd-vhost.conf
```
<VirtualHost api-rest:80>
  DocumentRoot "...\xampp\htdocs\api-rest\public"
  ServerAdmin api-rest
  <Directory "...\xampp\htdocs\api-rest">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
  </Directory>
</VirtualHost>
```

## Proyecto
1. Crear proyecto
```
composer create-project laravel/laravel=5.0 api-rest
```
2. Crear modelo Persona
``` php
<?php namespace App;

use Illuminate\Database\Eloquent\Model;


class Persona extends Model{
    protected $table="personas";
    protected $fillable=array("dui","nombre, apellido, fechaNacimiento");
}
```

3. Crear la Base de Datos

4. Crear Migración de Base de Datos
```
php artisan make:migration persona_migration --create=personas
```

5. Crear tabla en archivo de migración
```php
public function up()
	{
		Schema::create('personas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('dui');
			$table->string('nombre');
			$table->string('apellido');
			$table->date('fechaNacimiento');
			$table->timestamps();
		});
	}
```
6. Crear tabla migrations en BD
```
php artisan migrate:install
```

7. Crear tabla(s) en BD
```
php artisan migrate
```

8. Crear controladores REST
```
php artisan make:controller PersonaController
```

9. Agregar ruta en archivo routes.php 
```
Route::resource('persona','PersonaController');
```

10. Se puede verificar las URI para personas
```
php artisan route:list
``` 

11. Metodo GET  
``` php
public function index()
	{
		return response()->json(['datos'=>Persona::all()],200);
	}
``` 

12. Metodo PUT
``` php
public function update(Request $request, $id)
	{
		$metodo=$request->method();
		$persona=Persona::find($id);
		if($metodo==="PATCH"){
			$nombre=$request->get('nombre');
			if($nombre!=null && $nombre!=' '){
				$persona->nombre=$nombre;
				$persona->apellido=$apellido;
				$persona->fechaNacimiento=$fechaNacimiento;
			}
			$persona->save();
			return response()->json(['mensaje'=>'Registro actualizado','codigo'=>'204'],204);
		}
		$nombre=$request->get('nombre');
		$apellido=$request->get('apellido');
		if (!$nombre || !$apellido)
		{
			return response()->json(['mensaje'=>'El nombre o apellido no pueden ser nulos','codigo'=>'400'],400);
		}
		$persona->nombre=$nombre;
		$persona->apellido=$apellido;
		$persona->save();
		return response()->json(['mensaje'=>'Persona actualizada','codigo'=>'200'],200);
	}
``` 

13. Metodo POST
```php
public function store(Request $request)
	{
		if(!$request->get('dui') || !$request->get('nombre') || !$request->get('apellido') || !$request->get('fechaNacimiento')){
			return response()->json(['mensaje'=>'Datos incompletos'],400);
		}
		Persona::create($request->all());
		return response()->json(['mensaje'=>'Persona creada'],201);
	}

``` 

14. Metodo DELETE
``` php
public function destroy($id)
	{
		$persona=Persona::find($id);
		if(!$persona){
			return response()->json(['mensaje'=>'Persona no existe','codigo'=>'400'],400);
		}
		$persona->delete();
		return response()->json(['mensaje'=>'Persona eliminada','codigo'=>'204'],204);
		
	}
``` 

## Estandarización URI

| Verbo |	URI |	Acción | Ruta |
| ----- |	----- |	----- | ----- |
| GET |	/personas |	index |	personas.index |
| GET	| /personas/create	| create |	personas.create |
| POST | /personas	| store |	personas.store |
| GET	| /personas/{personas} |	show	| personas.show |
| GET	| /personas/{personas}/edit |	edit |	personas.edit |
| PUT/PATCH |	/personas/{personas} | update | personas.update |
| DELETE | /personas/{personas} |	destroy	| personas.destroy |

## Poblar Base de Datos
1. En clase DatabaseSeeder.php llamar a nuestra clase seeder
``` php
public function run()
	{
		$this->call('PersonaSeeder');
	}
```

2. Crear clase PersonaSeeder.php
``` php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Persona;
use Faker\Factory as Faker;

class PersonaSeeder extends Seeder {
    
    public function run()
    {
        $faker=Faker::create();
        for($i=0; $i<3; $i++)
        {
            Persona::create
            ([
                'dui'=>$faker->randomNumber(9),
                'nombre'=>$faker->firstName(),
                'apellido'=>$faker->lastName (),
                'fechaNacimiento'=>$faker->date()
            ]);
        }
    }
}
``` 

3. Buscar libreria faker
``` 
composer search faker
```

4. Descargar/Instalar libreria fzaninotto/faker
```
composer require fzaninotto/faker --dev
```

5. Actualizar información del cargador automático de clases 
```
composer dump-autoload
```

6. Poblar base de datos 
```
php artisan db:seed
```

## Configurar Pruebas
1. Para realizar pruebas
```
vendor/bin/phpunit
```
2. Es posible asignar alias para realizar pruebas
```
alias tst=vendor/bin/phpunit
```
3. Generar clase de pruebas
```
php artisan make:test PersonasModuleTest
```

## Referencias

Documentación oficial de laravel [Laravel framework](http://laravel.com/docs).

[Estandares de interoperabilidad de gobierno de El Salvador](https://github.com/dequisv/Estandares-Interoperabilidad)

[GitBook de Laravel](https://richos.gitbooks.io/laravel-5/content/)

[Libreria Faker](https://github.com/fzaninotto/Faker#fakerprovideren_usperson) para creación de data.