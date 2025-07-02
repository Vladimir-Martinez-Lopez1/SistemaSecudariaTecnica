Manual Técnico - Sistema de Gestión de Incidencias
Proyecto: Secundaria Técnica N. 66
Framework: Laravel
Descripción:
Este sistema de gestión estudiantil está diseñado para escuelas secundarias. Administra expedientes disciplinarios y médicos de los estudiantes de forma eficiente y segura.

------------------------------------------------------------
REQUISITOS DEL SISTEMA

Software Necesario
- PHP 8.1+
- Composer (Gestor de dependencias PHP)
- MySQL (Base de datos principal)
- Servidor Web (Apache o Nginx)

Framework y Dependencias
- Laravel Framework
- Spatie Laravel Permission (Control de acceso basado en roles)

------------------------------------------------------------
INSTALACIÓN Y CONFIGURACIÓN

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

Importar la base de datos: sistemasecundariatecnica.sql

4. Configuración de la Aplicación
php artisan key:generate
php artisan config:cache

5. Migraciones y Seeders
php artisan migrate
php artisan db:seed

6. Configuración de Permisos
El sistema utiliza permisos granulares:

ver-*       - Ver registros
crear-*     - Crear registros
editar-*    - Editar registros
mostrar-*   - Mostrar registros individuales
eliminar-*  - Eliminar registros

(roleController.php líneas 90-111)

7. Configuración de Storage
php artisan storage:link

------------------------------------------------------------
ESTRUCTURA DEL SISTEMA

Controladores Principales

Gestión Médica:
- justificanteMedicoController
- controlDeCitaController
- informeSaludController

Gestión Disciplinaria:
- paseSalidaController
- justiRetardoSocialeController

Administración:
- roleController
- userController

------------------------------------------------------------
FLUJO DE DATOS

Los controladores buscan estudiantes por matrícula y vinculan expedientes médicos o disciplinarios.

Ejemplo:
$alumno = Alumno::where('matricula', $request->matricula)->firstOrFail();
$expediente = ExpedienteMedico::where('alumno_id', $alumno->id)->firstOrFail();

------------------------------------------------------------
EJECUCIÓN DEL SISTEMA

Servidor de Desarrollo:
php artisan serve
Disponible en: http://localhost:8000

------------------------------------------------------------
CONFIGURACIÓN DE PRODUCCIÓN

- Configurar servidor web (Apache/Nginx)
- Habilitar SSL/HTTPS
- Optimizar configuración:
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache

------------------------------------------------------------
USUARIOS Y ROLES

Sistema de Autenticación:
Implementa middleware con permisos específicos para cada operación CRUD.
(Referencias en justificanteMedicoController.php:20-26)

Gestión de Roles:
Los roles se gestionan en roleController.php:96-111

------------------------------------------------------------
COLABORADORES

- Vladimir Martínez López: https://github.com/Vladimir-Martinez-Lopez1
- Edgar David López Crúz: https://github.com/edgarDLC
- Cristian Wesly Mendoza Nuñez: https://github.com/WENXEX
