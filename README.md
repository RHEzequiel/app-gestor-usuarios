# Sistema de Gestión Escolar UTN

Sistema web completo desarrollado en Laravel 12 para la gestión de usuarios escolares con autenticación por roles (Administrador, Profesor, Alumno). Incluye diseño responsivo con identidad visual de la UTN, gestión de perfiles con fotografías y funcionalidades específicas por rol.

## 🚀 Características Principales

### Autenticación Multi-Rol
- **Administrador**: Acceso completo al sistema, gestión de todos los usuarios
- **Profesor**: Visualización de alumnos y búsqueda por teléfono
- **Alumno**: Gestión de perfil personal

### Funcionalidades
- ✅ Registro e inicio de sesión con selección de rol
- ✅ Gestión de perfiles con fotografía
- ✅ Dashboard específico por rol
- ✅ Búsqueda de alumnos por teléfono (profesores)
- ✅ Panel administrativo completo
- ✅ Diseño responsivo con TailwindCSS
- ✅ Identidad visual UTN integrada

### Diseño y UX
- 🎨 Interfaz moderna y profesional
- 📱 Totalmente responsivo
- 🖼️ Subida y gestión de fotografías de perfil
- 🎯 Iconografía interna personalizada
- 🏫 Branding institucional UTN

## 📋 Requisitos del Sistema

- **PHP**: 8.2 o superior
- **Composer**: Para gestión de dependencias PHP
- **Node.js**: 18.x o superior
- **NPM**: Para dependencias frontend
- **MySQL**: 8.0 o superior (o SQLite para desarrollo)
- **Servidor Web**: Apache, Nginx o servidor integrado de Laravel

## 🛠️ Instalación

### 1. Clonar el Repositorio
```bash
git clone https://github.com/RHEzequiel/app-gestor-usuarios.git
cd app-gestor-usuarios
```

### 2. Instalar Dependencias Backend
```bash
composer install
```

### 3. Instalar Dependencias Frontend
```bash
npm install
```

### 4. Configuración del Entorno
```bash
# Copiar archivo de configuración
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate
```

### 5. Configuración de Base de Datos

Editar el archivo `.env` con tus credenciales de base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app_gestor_usuarios
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 6. Ejecutar Migraciones y Seeders
```bash
# Crear las tablas de la base de datos
php artisan migrate

# Ejecutar seeders (incluye usuario administrador)
php artisan db:seed
```

### 7. Crear Enlace Simbólico para Storage
```bash
php artisan storage:link
```

### 8. Compilar Assets Frontend
```bash
# Para desarrollo
npm run dev

# Para producción
npm run build
```

### 9. Iniciar Servidor de Desarrollo
```bash
php artisan serve
```

La aplicación estará disponible en: `http://localhost:8000`

## 👤 Usuarios por Defecto

El seeder crea automáticamente un usuario administrador:

- **Email**: `admin@utn.edu.ar`
- **Contraseña**: `password`
- **Rol**: Administrador

## 📁 Estructura del Proyecto

```
app-gestor-usuarios/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Controladores administrativos
│   │   │   └── Auth/            # Controladores de autenticación
│   │   └── Requests/            # Form requests de validación
│   ├── Models/
│   │   └── User.php             # Modelo principal con roles
│   └── Policies/                # Políticas de autorización
├── database/
│   ├── migrations/
│   │   ├── *_create_users_table.php
│   │   └── *_add_additional_fields_to_users_table.php
│   └── seeders/
│       ├── AdminUserSeeder.php  # Seeder del administrador
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── admin/               # Vistas administrativas
│   │   ├── auth/                # Vistas de autenticación
│   │   ├── dashboards/          # Dashboards por rol
│   │   └── layouts/             # Layouts base
│   └── css/                     # Estilos personalizados
├── routes/
│   ├── web.php                  # Rutas principales
│   └── auth.php                 # Rutas de autenticación
└── public/
    ├── storage/                 # Enlace simbólico para archivos
    └── *.png                    # Assets UTN
```

## 🎯 Uso del Sistema

### Para Administradores
1. Acceder con credenciales de administrador
2. Ver listado completo de usuarios registrados
3. Editar perfiles de cualquier usuario
4. Gestionar roles y permisos

### Para Profesores
1. Registrarse seleccionando rol "Profesor"
2. Acceder al dashboard de profesor
3. Buscar alumnos por número de teléfono
4. Ver información de estudiantes

### Para Alumnos
1. Registrarse seleccionando rol "Alumno"
2. Completar perfil con fotografía
3. Gestionar información personal
4. Acceder al dashboard estudiantil

## 🔐 Seguridad y Permisos

- **Autenticación**: Sistema robusto con validación por roles
- **Autorización**: Middleware y policies para control de acceso
- **Validación**: Form requests personalizados para cada operación
- **Protección CSRF**: Habilitada en todos los formularios
- **Sanitización**: Validación y limpieza de datos de entrada

## 🎨 Personalización Visual

### Identidad UTN
- Logo y favicon institucional
- Paleta de colores oficial
- Tipografía corporativa
- Assets gráficos personalizados

### Componentes Reutilizables
- Sistema de iconografía interna
- Formularios con validación visual
- Cards y layouts responsivos
- Gradientes y efectos modernos

## 📱 Características Técnicas

### Backend
- **Framework**: Laravel 12
- **Base de Datos**: MySQL con migraciones
- **Autenticación**: Laravel Breeze extendido
- **Validación**: Form Requests personalizados
- **Storage**: Sistema de archivos para fotografías

### Frontend
- **CSS Framework**: TailwindCSS
- **JavaScript**: Vanilla JS con componentes interactivos
- **Iconografía**: SVG interno personalizado
- **Responsividad**: Mobile-first design

## 🚀 Despliegue en Producción

### Configuración Recomendada
```bash
# Optimizar autoloader
composer install --optimize-autoloader --no-dev

# Compilar assets para producción
npm run build

# Cachear configuración
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Configurar permisos
chmod -R 755 storage bootstrap/cache
```

### Variables de Entorno Producción
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tu-dominio.com

# Configurar base de datos de producción
DB_CONNECTION=mysql
DB_HOST=tu-servidor-db
DB_DATABASE=tu_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña_segura
```

## 🤝 Contribución

1. Fork el proyecto
2. Crear rama para feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit cambios (`git commit -am 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crear Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver archivo `LICENSE` para más detalles.

## 📞 Soporte

Para soporte técnico o consultas sobre el proyecto:
- **Institución**: Universidad Tecnológica Nacional
- **Materia**: Programación IV
- **Repositorio**: [GitHub](https://github.com/RHEzequiel/app-gestor-usuarios)

---

**Desarrollado con ❤️ para la UTN**

7. Configurar el prefijo de WhatsApp en el archivo `.env` (código de país sin el símbolo +):
```
WHATSAPP_PREFIX=34
```

8. Crear el enlace simbólico para el almacenamiento:
```bash
php artisan storage:link
```

9. Ejecutar las migraciones y seeders:
```bash
php artisan migrate --seed
```

10. Compilar los assets:
```bash
npm run build
```

11. Iniciar el servidor:
```bash
php artisan serve
```

## Acceso al sistema

Tras la instalación, podrás ingresar con estas credenciales:

### Usuario administrador (docente)
- Email: admin@example.com
- Contraseña: password
- Creado automáticamente mediante AdminUserSeeder

### Alumnos
Los estudiantes pueden crear sus cuentas desde la página de registro, subiendo obligatoriamente su fotografía de perfil.

## Funcionalidades principales

- **Interfaz personalizada con identidad UTN**: Diseño con logo UTN (logo_utn.png) e interfaz adaptada.
- **Autenticación completa**: Sistema de login/registro usando Laravel Breeze.
- **Gestión de roles**: Diferenciación mediante campo `is_admin` en la tabla users.
- **Perfiles interactivos**: 
  - Número telefónico con campo `phone` en la base de datos.
  - Enlaces a redes profesionales mediante campo `professional_url`.
  - Fotografías de perfil almacenadas mediante campo `photo_path`.
- **Seguridad robusta**:
  - Rutas protegidas con middleware auth.
  - Políticas de usuario (UserPolicy) para control de acceso.
  - Validación de formularios mediante FormRequest.

## Flujo de Uso

1. **Docente**:
   - Inicia sesión con usuario administrador (admin@example.com).
   - Accede a `/admin/users` para ver el listado completo de usuarios.
   - Puede ver los detalles de cualquier usuario del sistema.

2. **Alumno**:
   - Se registra proporcionando nombre, email, contraseña y foto de perfil.
   - Opcionalmente puede añadir teléfono y enlace profesional.
   - Accede al dashboard y puede gestionar únicamente su propio perfil.

## Detalles de implementación

- **Pantalla principal**: Diseño con video de fondo y overlay para mejorar la legibilidad.
- **Autenticación**: Implementada con Laravel Breeze y personalizada con el logotipo UTN.
- **Roles y Permisos**: 
  - Sistema basado en el campo `is_admin` y UserPolicy para control de acceso.
  - Verificación de permisos para viewAny, view y update.
- **Recursos visuales**:
  - Logo UTN integrado en tamaño 140x140px con versionado para evitar caché.
  - Ruta admin/users para gestión de usuarios por parte de administradores.
  - Diseño responsive con ajustes para dispositivos móviles (sm:pt-0).

## Notas del desarrollador

Este proyecto fue creado como parte de la evaluación para Programación IV. La aplicación pone especial énfasis en:

1. **Experiencia de usuario**: Interfaz intuitiva con elementos visuales de la UTN.
2. **Seguridad**: Implementación robusta de autenticación y control de acceso.
3. **Arquitectura limpia**: Siguiendo las mejores prácticas de Laravel.

## Licencia

Proyecto académico desarrollado para UTN.
