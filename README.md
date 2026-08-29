# Software de Gestión Empresarial

Proyecto de la asignatura Software de Gestión Empresarial - Cotecnova 2026.

---

## Requisitos

- Docker Desktop con WSL2 activado
- Git
- Visual Studio Code

---

## Clase 1 - Entorno con Docker

Clona el repositorio y levanta los contenedores:

```bash
git clone https://github.com/jamescanos/SoftwareGestionEmpresarial.git
cd SoftwareGestionEmpresarial
docker-compose up -d
```

Accesos:
- PHP/Apache: http://localhost:8080
- phpMyAdmin: http://localhost:8081 — usuario: `root`, contraseña: `root_password`
- Base de datos: host `db`, BD `seminario_db`

---

## Clase 2 - Instalación de Laravel

Se creó el proyecto Laravel en la carpeta `sge`:

```bash
composer create-project laravel/laravel sge
```

Para correr el servidor:

```bash
cd sge
php artisan serve
```

Disponible en http://127.0.0.1:8000.

> `vendor/` y `.env` están en `.gitignore` y no se suben al repositorio.

---

## Clase 3 - Base de datos y primera modificación

### Archivo .env

Contiene las variables de configuración del proyecto. No se sube al repositorio.

| Variable | Valor |
|---|---|
| APP_ENV | local |
| APP_DEBUG | true |
| APP_URL | http://localhost:8000 |
| DB_CONNECTION | sqlite |
| SESSION_DRIVER | database |

### Estructura del proyecto

```
sge/
├── app/          → lógica, modelos y controladores
├── config/       → configuraciones
├── database/     → migraciones
├── public/       → punto de entrada (index.php)
├── resources/    → vistas Blade, CSS, JS
├── routes/       → rutas de la aplicación
├── storage/      → logs y caché
└── tests/        → pruebas
```

### Flujo de una petición

```
Navegador → index.php → Router → Controller → Model → BD
                                                     ↓
                                              View (Blade) → Respuesta
```

### Migraciones ejecutadas

```bash
php artisan migrate
```

Tablas creadas: `users`, `sessions`, `cache`, `jobs`, `password_reset_tokens`

### Vista modificada

Se editó `resources/views/welcome.blade.php`:
- Título: `Bienvenidos al Seminario Laravel`
- Encabezado: `Este es nuestro primer proyecto con Laravel`