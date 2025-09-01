# Sistema de Gestión Escolar UTN

Sistema web completo desarrollado en Laravel 12 para la gestión de usuarios escolares con autenticación por roles (Administrador, Profesor, Alumno). Incluye diseño responsivo con identidad visual de la UTN, gestión de perfiles con fotografías y funcionalidades específicas por rol.

## 🚀 Características Principales

- ✅ Autenticación multi-rol (Administrador, Profesor, Alumno)
- ✅ Gestión de perfiles con fotografía
- ✅ Dashboard específico por rol
- ✅ Búsqueda de alumnos por teléfono (profesores)
- ✅ Panel administrativo completo
- ✅ Diseño responsivo con identidad visual UTN

##  Requisitos del Sistema

- **PHP**: 8.2 o superior
- **Composer**: Para gestión de dependencias PHP
- **Node.js**: 18.x o superior
- **MySQL**: 8.0 o superior
- **Servidor Web**: Apache, Nginx o servidor integrado de Laravel

## 🛠️ Instalación

### 1. Clonar el Repositorio
```bash
git clone https://github.com/RHEzequiel/app-gestor-usuarios.git
cd app-gestor-usuarios
```

### 2. Instalar Dependencias
```bash
composer install
npm install
```

### 3. Configuración del Entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar Base de Datos
Editar el archivo `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app_gestor_usuarios
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Ejecutar Migraciones y Seeders
```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### 6. Compilar Assets e Iniciar
```bash
npm run dev
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

## 👤 Usuario Administrador por Defecto

- **Email**: `admin@utn.edu.ar`
- **Contraseña**: `password`
- **Rol**: Administrador

## 🎯 Uso del Sistema

### Administradores
- Acceso completo al sistema
- Gestión de todos los usuarios
- Panel administrativo en `/admin/users`

### Profesores
- Visualización de alumnos
- Búsqueda por número de teléfono
- Dashboard específico

### Alumnos
- Gestión de perfil personal
- Subida de fotografía obligatoria
- Dashboard estudiantil

## � Características Técnicas

### Backend
- **Framework**: Laravel 12
- **Autenticación**: Laravel Breeze extendido
- **Base de Datos**: MySQL con migraciones completas
- **Validación**: Form Requests personalizados

### Frontend
- **CSS Framework**: TailwindCSS
- **Diseño**: Responsivo con identidad UTN
- **Iconografía**: SVG interno personalizado

## � Estructura Principal

```
app-gestor-usuarios/
├── app/Http/Controllers/Admin/    # Controladores administrativos
├── app/Models/User.php           # Modelo con roles
├── database/seeders/             # Seeders con admin
├── resources/views/admin/        # Vistas administrativas
├── resources/views/auth/         # Autenticación
└── resources/views/dashboards/   # Dashboards por rol
```

## 🤝 Equipo de Desarrollo

- **Ramirez Hermosa Ezequiel** 
- **Ramirez Hermosa Betiana**   
- **Gonzalez Jonathan Alexander** 

## 📞 Información del Proyecto

- **Institución**: Universidad Tecnológica Nacional
- **Materia**: Programación IV
- **Repositorio**: [GitHub](https://github.com/RHEzequiel/app-gestor-usuarios)

---

**Desarrollado con ❤️ para la UTN**
