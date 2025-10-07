# 🔑 Control de Llaves

Sistema de gestión y control de llaves desarrollado bajo el patrón **MVC** con **PHP**, **MySQL** y **Bootstrap**, orientado a facilitar el registro, préstamo y control de llaves dentro de una organización.

---

## 🚀 Tecnologías utilizadas

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![IA](https://img.shields.io/badge/IA-Artificial%20Intelligence-blueviolet?style=for-the-badge)

---

## 🧩 Estructura del proyecto

```
control-de-llaves/
│
├── assets/          # Recursos estáticos (CSS, JS, imágenes)
├── config/          # Configuración del proyecto
├── controllers/     # Controladores del patrón MVC
├── cruds/           # Operaciones CRUD
├── models/          # Modelos (lógica de negocio y conexión DB)
├── database/        # Archivos SQL de la base de datos
│   └── control_de_llaves.sql
├── partials/        # Componentes reutilizables (header, footer, etc.)
├── views/           # Vistas (interfaz de usuario)
│   ├── dashboard.php
│   ├── empleados.php
│   ├── empresas.php
│   ├── incidencias.php
│   ├── llaves.php
│   ├── login.php
│   ├── logout.php
│   ├── registro.php
│   ├── roles.php
│   ├── usuarios.php
│   └── index.php
└── index.php        # Punto de entrada principal
```

---

## ⚙️ Requisitos previos

Asegúrate de tener instalados los siguientes componentes:

- [XAMPP](https://www.apachefriends.org/es/index.html) o [Laragon](https://laragon.org/)  
- PHP 7.4 o superior  
- MySQL 5.7 o superior  
- Navegador web actualizado  

---

## 🖥️ Instalación en localhost

### 1️⃣ Clonar el repositorio
Abre tu terminal y ejecuta:

```bash
git clone https://github.com/Milan3s/control_de_llaves.git
```

### 2️⃣ Mover el proyecto a la carpeta del servidor local
Copia la carpeta **control-de-llaves** a:

```
C:\xampp\htdocs\
```
(o en Laragon: `C:\laragon\www\`)

---

## 🗄️ Instalación de la base de datos

1. Inicia **Apache** y **MySQL** desde el panel de XAMPP o Laragon.  
2. Abre tu navegador y entra en:  
   ```
   http://localhost/phpmyadmin
   ```
3. Crea una nueva base de datos llamada:
   ```
   control_de_llaves
   ```
4. Importa el archivo SQL que se encuentra en:
   ```
   /control-de-llaves/database/control_de_llaves.sql
   ```
   Para hacerlo:
   - En phpMyAdmin, selecciona la base de datos.
   - Ve a la pestaña **Importar**.
   - Haz clic en **Seleccionar archivo** y elige `control_de_llaves.sql`.
   - Pulsa **Continuar**.

Una vez completado, se crearán las tablas necesarias.

---

## ▶️ Ejecución del proyecto

1. Asegúrate de que **Apache** y **MySQL** estén corriendo.  
2. En tu navegador, abre:

   ```
   http://localhost/control-de-llaves/
   ```

3. Ingresa con tus credenciales o regístrate como nuevo usuario.

---

## 🧠 Funcionalidades principales

- Gestión de usuarios (roles y permisos)  
- Registro de empleados y empresas  
- Control de llaves prestadas  
- Registro de incidencias  
- Panel de administración (Dashboard)  
- Sistema de login/logout seguro  
- Arquitectura **MVC**  
- Interfaz moderna con **Bootstrap**  

---

## 💡 Estructura MVC

El proyecto sigue el patrón **Modelo - Vista - Controlador (MVC)**:

- **Models/** → conexión y consultas a la base de datos  
- **Views/** → interfaz del usuario  
- **Controllers/** → lógica que conecta ambos  

---

## 🧰 Configuración adicional

Si necesitas cambiar la conexión a la base de datos, edita el archivo:
```
/config/database.php
```
Ejemplo:
```php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "control_de_llaves";
```

---

## 🧾 Licencia

Este proyecto es de uso educativo y puede ser adaptado libremente.  
© 2025 - Desarrollado por Milan3s 💻

---

## 📬 Contacto

Si tienes dudas o sugerencias:
**GitHub:** [Milan3s](https://github.com/Milan3s)
