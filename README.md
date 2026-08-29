# Software de Gestión Empresarial

Entorno de desarrollo configurado con Docker (PHP 8.2, MariaDB y phpMyAdmin). 
No se requiere instalar XAMPP ni WAMP.

## Requisitos previos

1. Docker Desktop (con WSL2 activado en Windows).
2. Git.
3. Visual Studio Code.

## Levantar el entorno

1. Clonar el repositorio:
```bash
git clone https://github.com/jamescanos/SoftwareGestionEmpresarial.git
cd SoftwareGestionEmpresarial
```

2. Crear la carpeta src si no existe:
```bash
mkdir src
```

3. Ejecutar los contenedores en segundo plano:
```bash
docker-compose up -d
```

4. Accesos para verificar el funcionamiento:
- Apache/PHP: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (Usuario: root / Clave: root_password)

Credenciales de conexión a la base de datos:
- Host: db
- Usuario: root (o dev_user)
- Contraseña: root_password (o dev_password)
- Base de datos: seminario_db

## Instalación de Laravel (Clase 2)

El framework Laravel se encuentra instalado en la carpeta `sge`.

Comando ejecutado con Composer en WSL2:
```bash
composer create-project laravel/laravel sge
```

Nota: La carpeta `vendor/` y el archivo `.env` están ignorados en el control de versiones por el archivo `.gitignore`.

Para levantar el servidor de desarrollo de Laravel:
```bash
cd sge
php artisan serve
```
El proyecto estará disponible en http://127.0.0.1:8000.

## Clase 3 - Configuración de base de datos y primera modificación

### Variables de entorno (.env)

El archivo `.env` contiene la configuración del proyecto. Las variables principales:

| Variable | Descripción | Valor usado |
|---|---|---|
| APP_NAME | Nombre de la app | Laravel |
| APP_ENV | Entorno | local |
| APP_DEBUG | Modo depuración | true |
| APP_URL | URL de la app | http://localhost:8000 |
| DB_CONNECTION | Motor de BD | sqlite |
| SESSION_DRIVER | Driver de sesiones | database |

El archivo `.env` no se sube al repositorio (está en `.gitignore`).

### Estructura de carpetas del proyecto Laravel

```
sge/
├── app/              # Lógica de la aplicación (Modelos, Controladores)
├── bootstrap/        # Arranque del framework
├── config/           # Archivos de configuración
├── database/         # Migraciones y seeders
├── public/           # Punto de entrada (index.php)
├── resources/        # Vistas (Blade), CSS, JS
│   └── views/
│       └── welcome.blade.php   ← vista principal modificada
├── routes/           # Definición de rutas
├── storage/          # Archivos generados, logs, caché
├── tests/            # Tests automatizados
├── .env              # Variables de entorno (no se sube)
├── artisan           # CLI de Laravel
└── composer.json     # Dependencias
```

### Diagrama del flujo de una petición HTTP en Laravel

```
Navegador → public/index.php → Kernel → Router (routes/web.php)
         → Controller → Model → Base de datos
         → View (Blade) → Respuesta HTML → Navegador
```

### Migraciones ejecutadas

```bash
php artisan migrate
```

Las tablas creadas en la base de datos (SQLite):
- `users`
- `password_reset_tokens`
- `sessions`
- `cache`
- `jobs`

### Vista welcome modificada

Se modificó `resources/views/welcome.blade.php`:
- Título: "Bienvenidos al Seminario Laravel"
- Encabezado principal: "Este es nuestro primer proyecto con Laravel"