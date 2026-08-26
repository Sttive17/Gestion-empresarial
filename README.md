# Proyecto: Software de Gestión Empresarial

¡Hola! Este es el repositorio para el proyecto de la clase de **Software de Gestión Empresarial**. 

Aquí estamos montando todo nuestro entorno de desarrollo usando **Docker**. La idea es que con unos poquitos comandos ya tengamos corriendo PHP, MariaDB y phpMyAdmin en nuestra compu local, sin tener que pelear instalando XAMPP o WAMP.

---

## ¿Qué necesitamos para empezar?

1. **Docker Desktop** (si usas Windows, asegúrate de tener el backend de WSL2 activado).  
   [Descargar Docker Desktop](https://www.docker.com/products/docker-desktop/)
2. **Git** (obvio, para clonar este repo).
3. **Visual Studio Code** (recomendadísimo) o tu editor de código favorito.

---

## Pasos para levantar el entorno

### 1. Clonar el repositorio
Abrimos nuestra terminal (WSL2, PowerShell o Bash) y corremos esto:
```bash
git clone https://github.com/jamescanos/SoftwareGestionEmpresarial.git
cd SoftwareGestionEmpresarial
```

### 2. Estructura Inicial
Si no está creada, armamos una carpeta llamada `src` que es donde va a vivir nuestro código:
```bash
mkdir src
```

### 3. Levantar los contenedores
En la raíz del proyecto (donde está el archivo `docker-compose.yml`), corremos este comando mágico:
```bash
docker-compose up -d
```
*(El `-d` es para que corra de fondo y nos deje seguir usando la consola).*

### 4. Verificar que todo funcione
- **PHP/Apache:** Entramos al navegador a `http://localhost:8080`. Ahí deberíamos ver la info de PHP (`phpinfo()`).
- **phpMyAdmin:** Entramos a `http://localhost:8081`. 
  - **Usuario:** `root`
  - **Contraseña:** `root_password`

Para conectarnos a la base de datos desde el código, usamos estos datos:
```text
Host: db
Usuario: root (o dev_user)
Contraseña: root_password (o dev_password)
Base de datos: seminario_db
```

---

## Actividad Clase 2: Instalación de Laravel

Como parte de la entrega de la **Clase 2**, instalamos el framework Laravel dentro de la carpeta `sge`. ¡Así lo hicimos!:

1. Usamos **Composer** desde la terminal (WSL2) para descargar todo el framework.
2. El comando que ejecutamos fue:
   ```bash
   composer create-project laravel/laravel sge
   ```
3. Las dependencias pesadas de la carpeta `vendor/` y nuestro archivo `.env` ya están en el `.gitignore` para no subir basura ni datos sensibles al repositorio.
4. Y para levantar el servidor de pruebas de Laravel, solo hay que entrar a la carpeta y correr:
   ```bash
   cd sge
   php artisan serve
   ```
   *(Esto nos levanta la web en `http://127.0.0.1:8000`)*.