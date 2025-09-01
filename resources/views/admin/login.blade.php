<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso Administrativo - Gestión Escolar</title>
    <link rel="icon" href="/logo_utn.png" sizes="any">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'instrument-sans', sans-serif;
            background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
            color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .admin-container {
            background-color: white;
            border-radius: 1.5rem;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 500px;
            width: 100%;
            color: #1a202c;
        }
        
        .admin-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .admin-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: #dc2626;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }
        
        .admin-header p {
            font-size: 0.9rem;
            color: #64748b;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }
        
        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s;
            background-color: #f9fafb;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #dc2626;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
        
        .btn-admin {
            width: 100%;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 38, 38, 0.3);
        }
        
        .back-link {
            text-align: center;
            margin-top: 2rem;
        }
        
        .back-link a {
            color: #6b7280;
            text-decoration: none;
            font-size: 0.875rem;
        }
        
        .back-link a:hover {
            color: #dc2626;
        }
        
        .error-message {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5L12 1z"></path>
                    <path d="M9 12l2 2 4-4"></path>
                </svg>
                Acceso Administrativo
            </h1>
            <p>Panel de administración del sistema escolar</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="error-message">
                {{ session('status') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Contraseña</label>
                <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                <input id="remember_me" type="checkbox" name="remember" style="margin: 0;">
                <label for="remember_me" style="margin: 0; font-size: 0.875rem;">Recordar sesión</label>
            </div>

            <button type="submit" class="btn-admin">
                Iniciar Sesión Administrativa
            </button>
        </form>

        <div class="back-link">
            <a href="{{ url('/') }}">← Volver al sitio principal</a>
        </div>
    </div>
</body>
</html>
