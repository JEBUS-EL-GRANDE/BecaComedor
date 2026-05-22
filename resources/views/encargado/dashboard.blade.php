<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Encargado - Comedor Universitario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            color: #333;
            padding: 20px;
        }
        
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Header Styles */
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #2e59d9 100%);
            color: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(78, 115, 223, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .user-avatar {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }
        
        .user-details h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .user-details p {
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .role-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            display: inline-block;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        /* Stats Cards */
        .stats-section {
            margin-bottom: 40px;
        }
        
        .stats-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .stats-title i {
            color: var(--primary-color);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }
        
        .stat-icon.primary { background: rgba(78, 115, 223, 0.1); color: var(--primary-color); }
        .stat-icon.success { background: rgba(28, 200, 138, 0.1); color: var(--success-color); }
        .stat-icon.warning { background: rgba(246, 194, 62, 0.1); color: var(--warning-color); }
        .stat-icon.danger { background: rgba(231, 74, 59, 0.1); color: var(--danger-color); }
        
        .stat-content h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark-color);
        }
        
        .stat-content p {
            color: var(--secondary-color);
            font-size: 1rem;
            font-weight: 500;
        }
        
        /* Quick Actions */
        .actions-section {
            margin-bottom: 40px;
        }
        
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }
        
        .action-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            border-color: var(--primary-color);
        }
        
        .action-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .action-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .action-icon.asistencia { background: linear-gradient(135deg, var(--success-color) 0%, #17a673 100%); }
        .action-icon.servicios { background: linear-gradient(135deg, var(--warning-color) 0%, #dda20a 100%); }
        
        .action-header h3 {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--dark-color);
            margin: 0;
        }
        
        .action-description {
            color: var(--secondary-color);
            margin-bottom: 25px;
            line-height: 1.6;
        }
        
        .action-features {
            list-style: none;
            margin-bottom: 25px;
        }
        
        .action-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            color: #666;
        }
        
        .action-features li i {
            color: var(--success-color);
            font-size: 0.9rem;
        }
        
        .action-button {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .action-button:hover {
            background: #3a56c4;
            color: white;
            transform: translateX(5px);
        }
        
        /* Logout Section */
        .logout-section {
            text-align: center;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .btn-logout {
            background: linear-gradient(135deg, var(--danger-color) 0%, #c23321 100%);
            color: white;
            border: none;
            padding: 14px 40px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(231, 74, 59, 0.3);
        }
        
        .btn-logout:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(231, 74, 59, 0.4);
        }
        
        /* Footer */
        .dashboard-footer {
            text-align: center;
            margin-top: 50px;
            color: var(--secondary-color);
            font-size: 0.9rem;
            padding: 20px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-header {
                padding: 30px 20px;
            }
            
            .user-info {
                flex-direction: column;
                text-align: center;
            }
            
            .stats-grid,
            .actions-grid {
                grid-template-columns: 1fr;
            }
            
            .stat-card,
            .action-card {
                padding: 25px;
            }
        }
        
        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="user-details">
                    <h1>¡Bienvenido, {{ Auth::user()->nombre }}!</h1>
                    <p>Panel de Control del Encargado</p>
                    <span class="role-badge">
                        <i class="fas fa-user-shield me-2"></i>ENCARGADO
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="actions-section">
            <h2 class="stats-title">
                <i class="fas fa-tachometer-alt"></i>
                Acciones Rápidas
            </h2>
            
            <div class="actions-grid">
                <!-- Asistencia Card -->
                <a href="{{ route('encargado.asistencia.index') }}" class="action-card">
                    <div class="action-header">
                        <div class="action-icon asistencia">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h3>Control de Asistencia</h3>
                    </div>
                    <p class="action-description">
                        Gestiona el registro de asistencias de los estudiantes. 
                        Crea nuevos registros, consulta el historial y genera reportes.
                    </p>
                    <ul class="action-features">
                        <li><i class="fas fa-check-circle"></i> Registrar nuevas asistencias</li>
                        <li><i class="fas fa-list"></i> Ver historial completo</li>
                        <li><i class="fas fa-chart-bar"></i> Generar estadísticas</li>
                    </ul>
                    <span class="action-button">
                        Acceder <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
                
                <!-- Servicios Card -->
                <a href="{{ route('encargado.servicios.index') }}" class="action-card">
                    <div class="action-header">
                        <div class="action-icon servicios">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3>Tipos de Servicio</h3>
                    </div>
                    <p class="action-description">
                        Administra los diferentes tipos de servicios alimenticios, 
                        horarios y configuraciones del comedor universitario.
                    </p>
                    <ul class="action-features">
                        <li><i class="fas fa-plus-circle"></i> Crear nuevos servicios</li>
                        <li><i class="fas fa-clock"></i> Configurar horarios</li>
                        <li><i class="fas fa-cog"></i> Gestionar opciones</li>
                    </ul>
                    <span class="action-button">
                        Acceder <i class="fas fa-arrow-right"></i>
                    </span>
                </a>
            </div>
        </div>
        
        <!-- Logout Section -->
        <div class="logout-section">
            <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                @csrf
                <button type="submit" class="btn-logout" id="logoutBtn">
                    <span>Cerrar Sesión</span>
                    <i class="fas fa-sign-out-alt"></i>
                    <div class="loading" style="display: none;"></div>
                </button>
            </form>
        </div>
        
        <!-- Footer -->
        <div class="dashboard-footer">
            <p>
                <i class="fas fa-copyright me-1"></i>
                Sistema de Comedor Universitario - {{ date('Y') }}
                <span class="mx-3">|</span>
                <i class="fas fa-user-tie me-1"></i>
                Panel del Encargado v1.0
            </p>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animación de logout
        document.getElementById('logoutForm').addEventListener('submit', function(e) {
            const logoutBtn = document.getElementById('logoutBtn');
            const loading = logoutBtn.querySelector('.loading');
            const text = logoutBtn.querySelector('span');
            const icon = logoutBtn.querySelector('.fa-sign-out-alt');
            
            logoutBtn.disabled = true;
            text.style.display = 'none';
            icon.style.display = 'none';
            loading.style.display = 'inline-block';
        });
        
        // Actualizar estadísticas en tiempo real (opcional)
        function updateStats() {
            const dateElement = document.querySelector('.stat-content h3:nth-child(4)');
            if (dateElement) {
                const now = new Date();
                dateElement.textContent = now.getDate().toString().padStart(2, '0');
                
                const monthNames = [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ];
                document.querySelector('.stat-content p:nth-child(4)').textContent = 
                    monthNames[now.getMonth()] + ' ' + now.getFullYear();
            }
        }
        
        // Actualizar cada minuto
        setInterval(updateStats, 60000);
        
        // Efecto hover en tarjetas
        document.querySelectorAll('.action-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>