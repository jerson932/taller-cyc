<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller CyC</title>
    <meta name="description" content="Sistema de gestión de clientes, vehículos, órdenes y pagos del Taller CyC.">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
        }

        /* Navbar moderno */
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
        }
        .nav-link {
            color: #495057 !important;
            font-weight: 500;
        }
        .nav-link:hover {
            color: #0d6efd !important;
        }

        /* Contenedor de notificaciones */
        .flash-messages {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1055;
            max-width: 360px;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }
        .fade-out {
            opacity: 1;
            transform: translateY(0);
            animation: fadeOutDown 0.8s forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeOutDown {
            to {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        /* Footer elegante */
        footer {
            background-color: #ffffff;
            color: #6c757d;
            font-size: 0.9rem;
            box-shadow: 0 -2px 6px rgba(0,0,0,0.05);
        }

        /* Estilo general de cards */
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
        }

        /* Botones primarios más suaves */
        .btn-primary {
            background-color: #0d6efd;
            border: none;
            transition: background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">⚙ Taller CyC</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Menú de navegación">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto gap-2">
                        <li class="nav-item"><a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('vehiculos.index') }}">Vehículos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('ordenes.index') }}">Órdenes</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('servicios.index') }}">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('pagos.index') }}">Pagos</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenido dinámico -->
    <main class="container my-5 flex-grow-1">
        @yield('content')
    </main>

    <!-- Notificaciones flash -->
    <div class="flash-messages">
        @if(session('success'))
            <div class="alert alert-success fade-in shadow-sm mb-2 rounded-3">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger fade-in shadow-sm mb-2 rounded-3">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="py-3 mt-auto text-center">
        <div class="container">
            <small>&copy; {{ date('Y') }} Taller CyC. Todos los derechos reservados.</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para fade out de alertas -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const alerts = document.querySelectorAll('.flash-messages .alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.remove('fade-in');
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 800);
                }, 3000);
            });
        });
    </script>
</body>
</html>
