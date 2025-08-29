# Aplicación de Gestión de Usuarios UTN

Proyecto desarrollado para la materia Programación IV. Sistema web basado en Laravel 12 y MySQL que implementa un gestor de usuarios con identidad visual de la UTN. Permite a los docentes (rol administrador) ver el listado completo de usuarios, mientras que los alumnos pueden gestionar su perfil personal con foto y enlaces profesionales.

## Requisitos

- PHP 8.2 o superior
- Composer
- MySQL o SQLite
- Node.js y npm
- Servidor web (Apache, Nginx) o el servidor integrado de Laravel

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/ezequielhramirez/app-gestor-usuarios.git
cd app-gestor-usuarios
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de JavaScript:
```bash
npm install
```

4. Copiar el archivo de entorno y configurar las variables:
```bash
cp .env.example .env
```

5. Generar la clave de la aplicación:
```bash
php artisan key:generate
```

6. Configurar la base de datos en el archivo `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app_gestor_usuarios
DB_USERNAME=root
DB_PASSWORD=
```

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
