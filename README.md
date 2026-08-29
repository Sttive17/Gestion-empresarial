# Software de Gestión Empresarial

Repositorio del proyecto para la asignatura Software de Gestión Empresarial - Cotecnova 2026.

## Requisitos previos

1. Docker Desktop (con WSL2 activado en Windows).
2. Git.
3. Visual Studio Code.

## Levantar el entorno Docker (Clase 1)

1. Clonar el repositorio:
```bash
git clone https://github.com/jamescanos/SoftwareGestionEmpresarial.git
cd SoftwareGestionEmpresarial
```

2. Crear la carpeta src si no existe:
```bash
mkdir src
```

3. Ejecutar los contenedores:
```bash
docker-compose up -d
```

4. Accesos:
- Apache/PHP: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (Usuario: root / Clave: root_password)

Credenciales de la base de datos:
- Host: db
- Usuario: root (o dev_user)
- Contraseña: root_password (o dev_password)
- Base de datos: seminario_db

---

## Clase 2 - Instalación de Laravel

Se instaló el framework Laravel en la carpeta `sge` usando Composer desde WSL2:

```bash
composer create-project laravel/laravel sge
```

La carpeta `vendor/` y el archivo `.env` no se suben al repositorio, están en el `.gitignore`.

Para correr el servidor de desarrollo:
```bash
cd sge
php artisan serve
```

El proyecto queda disponible en http://127.0.0.1:8000.

---

## Clase 3 - Base de datos, variables de entorno y primera modificación

### Variables de entorno (.env)

El archivo `.env` tiene la configuración del proyecto según el entorno. Las más importantes:

| Variable | Descripción | Valor |
|---|---|---|
| APP_NAME | Nombre de la app | Laravel |
| APP_ENV | Entorno de ejecución | local |
| APP_DEBUG | Modo depuración | true |
| APP_URL | URL de la app | http://localhost:8000 |
| DB_CONNECTION | Motor de base de datos | sqlite |
| SESSION_DRIVER | Driver de sesiones | database |

El `.env` no se sube al repositorio porque tiene datos sensibles.

### Estructura de carpetas

```
sge/
├── app/              # Modelos, Controladores, lógica
├── bootstrap/        # Arranque del framework
├── config/           # Configuraciones
├── database/         # Migraciones y seeders
├── public/           # index.php, punto de entrada
├── resources/        # Vistas Blade, CSS, JS
│   └── views/
│       └── welcome.blade.php   ← modificada en clase 3
├── routes/           # Rutas de la aplicación
├── storage/          # Logs, caché, archivos generados
├── tests/            # Pruebas automatizadas
├── artisan           # CLI de Laravel
└── composer.json     # Dependencias del proyecto
```

### Flujo de una petición HTTP en Laravel

```
Navegador → public/index.php → Kernel → Router (routes/web.php)
         → Controller → Model → Base de datos
         → View (Blade) → Respuesta HTML → Navegador
```

### Migraciones

Se ejecutaron las migraciones con:
```bash
php artisan migrate
```

Tablas creadas en la base de datos (SQLite):
- `users`
- `password_reset_tokens`
- `sessions`
- `cache`
- `jobs`

### Modificación de la vista welcome

Se editó `resources/views/welcome.blade.php` cambiando:
- Título de la pestaña: `Bienvenidos al Seminario Laravel`
- Encabezado principal: `Este es nuestro primer proyecto con Laravel`