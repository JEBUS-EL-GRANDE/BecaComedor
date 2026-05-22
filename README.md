# BecaComedor — Sistema de Gestion del Comedor Universitario

Sistema web para la gestión del comedor universitario de la **U.A.G.R.M.**, desarrollado como proyecto de la materia **Sistemas de Información 1 (INF-342)**. Permite administrar la asistencia de estudiantes al comedor, gestionar tipos de beca, horarios de servicio, y controlar el acceso de personal administrativo, encargados y personal de cocina.


## Stack Tecnológico

| Capa | Tecnología |
|------|-----------|
| **Backend** | PHP 8.2+, Laravel 12.2 |
| **Frontend 1 (SPA)** | Vue 3 + TypeScript, Tailwind CSS 4, Inertia.js 2 |
| **Frontend 2 (Blade)** | Bootstrap 5.3, Font Awesome 6 |
| **Base de Datos** | PostgreSQL |
| **Autenticación** | Laravel Fortify + sistema de roles personalizado |
| **Build Tool** | Vite 7.x |
| **Dev Environment** | Laravel Sail (Docker) |


## Arquitectura General

El sistema tiene dos frentes:

1. **Blade + Bootstrap** — usado por los paneles de administracion, encargado, cocina y asistencia publica. Son vistas renderizadas del lado del servidor.

## Roles del Sistema

El sistema cuenta con **4 roles** con portales independientes:

### 1. ADMINISTRADOR
- **Login:** `/admin/login`
- **Dashboard:** `/admin/dashboard`
- **Permisos:** CRUD completo sobre 8 entidades:
  - Personas
  - Carreras
  - Estudiantes
  - Encargados
  - Personal de Cocina
  - Tipos de Beca
  - Particulares
  - Administradores
- Middleware: `AdminMiddleware` (verifica rol `ADMINISTRADOR`)

### 2. ENCARGADO (Supervisor)
- **Login:** `/encargado/login`
- **Dashboard:** `/encargado/dashboard`
- **Permisos:**
  - CRUD de Control de Asistencia (registro de comidas de estudiantes)
  - CRUD de Tipos de Servicio (configuración de horarios de comidas)
- Middleware: `CheckRole:ENCARGADO`

### 3. PERSONAL COCINA
- **Login:** `/cocina/login`
- **Vista:** `/cocina/horario` (solo lectura)
- **Permisos:** Visualizar su especialidad y horario asignado
- Middleware: `rol:PERSONAL_COCINA`

### 4. ESTUDIANTE (Asistencia Pública)
- **Acceso:** `/asistencia/registrar`
- **Flujo:** El estudiante ingresa su CI y contraseña, selecciona el tipo de servicio (almuerzo, cena, etc.), y el sistema registra su asistencia.
- **Restriccion:** No permite registrar mas de una asistencia por dia.
- No requiere sesion persistente (autoservicio).

--------------------------------------------------------------------------------

## Modelo de Datos (14 tablas)

### Tabla principal
- **personas** — Tabla de autenticación principal. Almacena nombre, apellido, CI (unico), contraseiaa, email, telefono, direccion, sexo y rol.

### Flujo de login
1. El usuario ingresa su CI y contraseña.
2. Se busca en la tabla `personas` por CI.
3. Se compara la contraseña (almacenada actualmente en texto plano como solución temporal).
4. Dependiendo del rol, se redirige al portal correspondiente.

> **Nota:** Las contraseñas están en texto plano como medida temporal durante el desarrollo.

---

## Estructura del Proyecto

```
BecaComedor/
├── app/
│   ├── Actions/Fortify/       # Acciones de Fortify (crear usuario, reset pass)
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/         # 8 controladores CRUD del admin
│   │   │   ├── Encargado/     # 2 controladores CRUD del encargado
│   │   │   ├── Settings/      # Perfil, contraseña, 2FA
│   │   │   ├── AdminController.php
│   │   │   ├── EncargadoController.php
│   │   │   ├── CocinaController.php
│   │   │   ├── AsistenciaPublicaController.php
│   │   │   └── AuthController.php
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php       # Verifica rol ADMINISTRADOR
│   │   │   ├── CheckRole.php            # Verifica roles genéricos
│   │   │   └── HandleInertiaRequests.php
│   │   └── Requests/Settings/
│   ├── Models/
│   │   ├── Persona.php         # Modelo autenticable principal
│   │   ├── Administrador.php
│   │   ├── Encargado.php
│   │   ├── PersonalCocina.php
│   │   ├── Estudiante.php
│   │   ├── Particular.php
│   │   ├── Carrera.php
│   │   ├── TipoBeca.php
│   │   ├── TipoServicio.php
│   │   └── ControlAsistencia.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── FortifyServiceProvider.php
├── database/
│   ├── migrations/             # 14 migraciones
│   └── seeders/
├── resources/
│   ├── views/                   # Plantillas Blade (admin, encargado, cocina, asistencia, auth)
│   └── js/                      # Frontend Vue 3 + Inertia
│       ├── pages/               # Páginas (auth/, settings/, Dashboard.vue, Welcome.vue)
│       ├── components/          # Componentes reutilizables
│       ├── layouts/             # Layouts (AppLayout, AuthLayout, settings/)
│       └── composables/         # Composables (apariencia, iniciales, 2FA)
├── routes/
│   ├── web.php                  # Rutas principales
│   ├── settings.php             # Rutas de configuración (Inertia)
│   └── console.php
├── config/
│   ├── auth.php                 # Guard personalizado (Persona)
│   ├── fortify.php              # Configuración de Fortify
│   └── inertia.php              # SSR
└── vite.config.ts
```

---

## Funcionalidades Principales

### Administración
- CRUD completo de personas, carreras, estudiantes, encargados, personal de cocina, tipos de beca, particulares y administradores.
- Busqueda por nombre, CI y carrera.
- Filtro por carrera en listado de estudiantes.
- Paginacion en tablas.

### Control de Asistencia (Encargado)
- Registro de que estudiantes asistieron al comedor y que servicio tomaron.
- Cada estudiante puede registrar **una sola asistencia por día** (validado en backend).

### Tipos de Servicio (Encargado)
- Configuración de horarios de servicio (ej. Almuerzo 11:00-13:00, Cena 17:00-18:00).

### Autoservicio del Estudiante
- El estudiante ingresa su CI y contraseña.
- Selecciona el tipo de servicio.
- El sistema valida que no haya registrado asistencia ese día.
- Muestra confirmación de éxito.

### Personal de Cocina
- Visualización de su especialidad y horario de trabajo asignado.

# apps que se tilizaron 

para la relaizacion de este proyecto se uso las app de 
1.postgresSQl   (la base de datos)
2.Git           (sistema de control de versiones distribuido.)
3.Visual Studio Code(como un IDE)
4.laravel       (framework=un framework te proporciona un punto de partida sólido y un conjunto de herramientas 
                para construir aplicaciones de manera más eficiente y organizada. Laravel es un ejemplo de framework, Piensa en él como un esqueleto preconstruido que te ayuda a organizar y acelerar el proceso de creación de una aplicación.)
5.Composer      (Composer es un gestor de dependencias para PHP. Simplifica la gestion de bibliotecas y paquetes de              software en tus proyectos PHP.)


## Instalacion del laravel
Abre el git y empiza la instalacion con los sgte comandos
>composer global require laravel/installer
>laravel new NombreDelproyecto
>instala el vue y luego el laravel le das a que si a todo


>composer require inertiajs/inertia-laravel
>npm install @inertiajs/vue3 vue @vitejs/plugin-vue
>npm install --save-dev vite laravel-vite-plugin

## Instalación y Ejecución

### Requisitos
- PHP 8.2+
- Composer
- Node.js 18+
- PostgreSQL

### Pasos
```bash
# 1. Clonar el repositorio
git clone <repo-url>
cd BecaComedor

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JS
npm install

# 4. Configurar variables de entorno
cp .env.example .env
# Editar .env con los datos de conexión a PostgreSQL

# 5. Ejecutar migraciones
php artisan migrate

# 6. Compilar assets
npm run build

# 7. Iniciar servidor de desarrollo
php artisan serve
### Compilar assets en modo desarrollo en una segunda terminal
```bash
npm run dev
```
### SSR (Server-Side Rendering)
```bash
php artisan inertia:start-ssr