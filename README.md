Manual Técnico - SISTEMA DE GESTIÓN DE INCIDENCIAS: SECUNDARIA TÉCNICA N. 66
Este es un sistema de gestión estudiantil para escuelas secundarias construido con Laravel que maneja expedientes disciplinarios y médicos de estudiantes .

Requisitos del Sistema
Software Necesario
PHP 8.1+ (requerido por las dependencias del proyecto) composer.lock:24
Composer para gestión de dependencias PHP composer.lock:1-7
MySQL como base de datos principal database.php:91-98
Servidor web (Apache/Nginx)
Framework y Dependencias
Laravel Framework (framework principal) README.md:10-22
Spatie Laravel Permission para control de acceso basado en roles permission.php:91-150
Instalación y Configuración
1. Clonar el Repositorio
git clone https://github.com/Vladimir-Martinez-Lopez1/SistemaSecudariaTecnica.git
cd SistemaSecudariaTecnica
2. Instalar Dependencias
composer install
3. Configuración de Base de Datos
Crear archivo .env basado en .env.example y configurar:

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=proyecto_secundaria_tec  
DB_USERNAME=root  
DB_PASSWORD= 
Importar la base de datos creada con el nombre "sistemasecundariatecnica.sql"

4. Configuración de Aplicación
php artisan key:generate  
php artisan config:cache

5. Migraciones y Seeders
php artisan migrate  
php artisan db:seed



6. Configuración de Permisos
El sistema utiliza un sistema de permisos granular con patrones específicos roleController.php:90-111:

ver-* - Ver registros
crear-* - Crear registros
editar-* - Editar registros
mostrar-* - Mostrar registros individuales
eliminar-* - Eliminar registros

7. Configuración de Storage
php artisan storage:link (importante, para poder utilizar los iconos)

ESTRUCTURA DEL SISTEMA - Controladores Principales

Gestión Médica: justificanteMedicoController, controlDeCitaController, informeSaludController justificanteMedicoController.php:15-26
Gestión Disciplinaria: paseSalidaController, justiRetardoSocialeController paseSalidaController.php:61-92
Administración: roleController, userController roleController.php:61-68

FLUJO DE DATOS
Todos los controladores siguen el patrón de buscar estudiantes por matrícula y vincular con expedientes médicos/disciplinarios justificanteMedicoController.php:47-60 :

$alumno = Alumno::where('matricula', $request->matricula)->firstOrFail();  
$expediente = ExpedienteMedico::where('alumno_id', $alumno->id)->firstOrFail();

EJECUCIÓN DEL SISTEMA - Servidor de Desarrollo
php artisan serve
El sistema estará disponible en http://localhost:8000

Configuración de Producción
Configurar servidor web (Apache/Nginx)
Configurar SSL/HTTPS
Optimizar configuración:
php artisan config:cache  
php artisan route:cache  
php artisan view:cache
Usuarios y Roles
Sistema de Autenticación
El sistema implementa control de acceso basado en roles con middleware de permisos justificanteMedicoController.php:20-26 . Cada controlador requiere permisos específicos para cada operación CRUD.

Gestión de Roles
Los roles se gestionan a través del roleController que permite crear, editar y asignar permisos roleController.php:96-111.

Colaboradores del sistema:
[Vladimir Martínez López.](https://github.com/Vladimir-Martinez-Lopez1)
[Edgar David López Crúz.](https://github.com/edgarDLC)
[Cristian Wesly Mendoza Nuñez.](https://github.com/WENXEX)
