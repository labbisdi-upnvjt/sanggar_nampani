<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['user'])) {
    header('Location: index.php?page=dashboard');
    exit;
}

if (isset($_GET['expired'])) {
    $error = 'Sesi Anda telah berakhir. Silakan login kembali.';
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi!';
    } else {
        try {
            global $db;
            $stmt = $db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'full_name' => $user['full_name'],
                'role' => $user['role']
            ];
            $_SESSION['flash_success'] = "Login berhasil.";

            header('Location: index.php?page=dashboard');
            exit;

            } else {
                $error = 'Username atau Password salah!';
            }
        } catch (Exception $e) {
            $error = 'Terjadi kesalahan sistem. Silakan coba lagi.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMS Sanggar Nampani</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/project_sanggar/public/assets/css/bootstrap/bootstrap.min.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #1e1e24 0%, #111115 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f8f9fa;
        }
        .login-card {
            background: rgba(30, 30, 38, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo h3 {
            font-weight: 700;
            color: #ffc107;
            letter-spacing: 1px;
        }
        .login-logo p {
            color: #a0aec0;
            font-size: 0.9rem;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: #f8f9fa;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #ffc107;
            box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
            color: #f8f9fa;
        }
        .form-label {
            font-weight: 600;
            color: #cbd5e0;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        .btn-primary {
            background: #ffc107;
            border: none;
            border-radius: 12px;
            color: #111115;
            font-weight: 700;
            padding: 12px;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #e0a800;
            color: #111115;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .alert-custom {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            border-radius: 12px;
            font-size: 0.875rem;
            padding: 12px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-logo">
        <h3>SANGGAR NAMPANI</h3>
        <p>CMS Administrator Panel</p>
    </div>

    <?php if ($msg = flash('flash_success')): ?>
    <div class="alert alert-success mb-3">
        <?= htmlspecialchars($msg) ?>
    </div>
    <?php endif; ?>

        <?php if ($msg = flash('flash_error')): ?>
            <div class="alert alert-danger mb-3">
                <?= htmlspecialchars($msg) ?>
            </div>
        <?php endif; ?>

    <?php if ($error !== ''): ?>
        <div class="alert alert-custom mb-4" role="alert">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username admin" style="color: white;" required autocomplete="username">
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" style="color: white;" required autocomplete="current-password">
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk Aplikasi</button>
    </form>
</div>

</body>
</html>