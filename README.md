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