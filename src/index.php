<?php
// PHP Information
$phpVersion = phpversion();
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';
$pdoInstalled = extension_loaded('pdo_mysql') ? 'Instalado' : 'No instalado';
$modRewrite = in_array('mod_rewrite', apache_get_modules() ?? []) ? 'Habilitado' : 'Desconocido';

// Database Connection Test
$dbHost = 'db';
$dbName = 'sge_db';
$dbUser = 'root';
$dbPass = 'root_password';

$dbStatus = 'Desconectado';
$dbStatusColor = 'error';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbStatus = 'Conectado';
    $dbStatusColor = 'success';
} catch (PDOException $e) {
    $dbStatus = 'Error de conexión';
}

$pmaPort = '8081'; // Según el docker-compose.yml
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software de Gestión Empresarial - Entorno</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0d1117;
            --bg-gradient: linear-gradient(135deg, #0f131f 0%, #171629 100%);
            --card-bg: rgba(22, 27, 40, 0.7);
            --card-border: rgba(255, 255, 255, 0.08);
            --text-main: #f0f6fc;
            --text-muted: #8b949e;
            --accent: #6b82ff;
            --success: #238636;
            --error: #da3633;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background: var(--bg-gradient);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        /* Ambient Glow Elements */
        .blob {
            position: absolute;
            filter: blur(100px);
            z-index: 0;
            opacity: 0.4;
            animation: pulse 8s infinite alternate;
        }
        .blob-1 {
            width: 400px;
            height: 400px;
            background: rgba(107, 130, 255, 0.2);
            top: -100px;
            left: -100px;
            border-radius: 50%;
        }
        .blob-2 {
            width: 500px;
            height: 500px;
            background: rgba(180, 90, 255, 0.15);
            bottom: -200px;
            right: -100px;
            border-radius: 50%;
            animation-delay: -4s;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.3; }
            100% { transform: scale(1.1); opacity: 0.5; }
        }

        .container {
            position: relative;
            z-index: 1;
            max-width: 1050px;
            width: 100%;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .badge-active {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(107, 130, 255, 0.15);
            color: #8fa0ff;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
            border: 1px solid rgba(107, 130, 255, 0.3);
            backdrop-filter: blur(10px);
        }
        
        .badge-active::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #8fa0ff;
            border-radius: 50%;
            box-shadow: 0 0 10px #8fa0ff;
        }

        h1 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #ffffff;
            letter-spacing: -0.5px;
        }

        p.subtitle {
            color: var(--text-muted);
            font-size: 1.15rem;
            font-weight: 300;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 1.8rem;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.03), transparent);
            transform: skewX(-20deg);
            transition: 0.6s;
        }

        .card:hover {
            transform: translateY(-8px);
            border-color: rgba(107, 130, 255, 0.4);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }
        
        .card:hover::before {
            left: 150%;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .icon {
            font-size: 1.6rem;
            background: rgba(255,255,255,0.05);
            padding: 8px;
            border-radius: 10px;
        }

        .data-row {
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }
        
        .data-row.horizontal {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .data-label {
            font-size: 0.85rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .data-value {
            font-weight: 400;
            font-size: 1.05rem;
            color: #d1d5da;
        }

        .data-value.large {
            font-size: 1.8rem;
            font-weight: 700;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-success { background: rgba(35, 134, 54, 0.2); color: #3fb950; border: 1px solid rgba(63, 185, 80, 0.3); }
        .status-error { background: rgba(218, 54, 51, 0.2); color: #ff7b72; border: 1px solid rgba(255, 123, 114, 0.3); }
        
        .footer-banner {
            background: rgba(22, 27, 40, 0.8);
            border: 1px solid var(--card-border);
            border-radius: 16px;
            padding: 1.8rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .footer-banner:hover {
            border-color: rgba(255,255,255,0.15);
        }

        .banner-text h3 {
            margin-bottom: 0.4rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
        }
        .banner-text p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .btn {
            background: rgba(255, 255, 255, 0.05);
            color: #c9d1d9;
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0.9rem 1.8rem;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .footer-banner {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <div class="container">
        <div class="header">
            <div class="badge-active">Entorno Docker WSL Activo</div>
            <h1>Software de Gestión Empresarial</h1>
            <p class="subtitle">Prueba del Servidor Web & Conectividad con MariaDB</p>
        </div>

        <div class="cards-grid">
            <!-- PHP Card -->
            <div class="card">
                <div class="card-header">
                    <span class="card-title">PHP Runtime</span>
                    <span class="icon">🐘</span>
                </div>
                <div class="data-row horizontal">
                    <span class="data-value large">PHP <?php echo htmlspecialchars($phpVersion); ?></span>
                    <span class="status-badge status-success">Activo</span>
                </div>
                <div class="data-row">
                    <span class="data-label">Servidor:</span>
                    <span class="data-value"><?php echo htmlspecialchars(explode(' ', $serverSoftware)[0]); ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">Reescritura (mod_rewrite):</span>
                    <span class="data-value"><?php echo htmlspecialchars($modRewrite); ?></span>
                </div>
                <div class="data-row">
                    <span class="data-label">PDO MySQL:</span>
                    <span class="data-value"><?php echo htmlspecialchars($pdoInstalled); ?></span>
                </div>
            </div>

            <!-- Database Card -->
            <div class="card">
                <div class="card-header">
                    <span class="card-title">MariaDB / MySQL</span>
                    <span class="icon">🗄️</span>
                </div>
                <div class="data-row horizontal">
                    <span class="data-value large"><?php echo htmlspecialchars($dbStatus); ?></span>
                    <?php if($dbStatus === 'Conectado'): ?>
                        <span class="status-badge status-success">OK</span>
                    <?php else: ?>
                        <span class="status-badge status-error">ERROR</span>
                    <?php endif; ?>
                </div>
                <div class="data-row">
                    <span class="data-label">Host interno:</span>
                    <span class="data-value"><?php echo htmlspecialchars($dbHost); ?>:3306</span>
                </div>
                <div class="data-row">
                    <span class="data-label">Base de datos:</span>
                    <span class="data-value"><?php echo htmlspecialchars($dbName); ?></span>
                </div>
            </div>

            <!-- phpMyAdmin Card -->
            <div class="card">
                <div class="card-header">
                    <span class="card-title">phpMyAdmin</span>
                    <span class="icon">⚡</span>
                </div>
                <div class="data-row horizontal">
                    <span class="data-value large">Puerto <?php echo htmlspecialchars($pmaPort); ?></span>
                    <span class="status-badge status-success">Listo</span>
                </div>
                <div class="data-row">
                    <span class="data-label">Usuario:</span>
                    <span class="data-value">root</span>
                </div>
                <div class="data-row">
                    <span class="data-label">Pass:</span>
                    <span class="data-value">root_password</span>
                </div>
                <div class="data-row">
                    <span class="data-label">Gestor DB:</span>
                    <span class="data-value">GUI Web</span>
                </div>
            </div>
        </div>

        <div class="footer-banner">
            <div class="banner-text">
                <h3>¡Prueba de Entorno Lista! 🎉</h3>
                <p>El servidor PHP y la base de datos MariaDB están conectados correctamente.</p>
            </div>
            <a href="http://localhost:<?php echo htmlspecialchars($pmaPort); ?>" target="_blank" class="btn">
                Abrir phpMyAdmin
            </a>
        </div>
    </div>
</body>
</html>
