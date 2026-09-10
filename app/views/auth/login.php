<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$auth_error = $_SESSION['auth_error'] ?? null;
unset($_SESSION['auth_error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Login – MinSU Portal') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --red:        #dc2626;
            --red-light:  #f87171;
            --red-dim:    #7f1d1d;
            --bg:         #080808;
            --bg2:        #101010;
            --bg3:        #181818;
            --border:     rgba(220,38,38,0.15);
            --border-hot: rgba(220,38,38,0.5);
            --text:       #f0f0f0;
            --muted:      #6b6b6b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: grid;
            grid-template-rows: auto 1fr auto;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2.5rem;
            height: 56px;
            border-bottom: 1px solid var(--border);
            background: var(--bg);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .nav-logo {
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            font-size: 1.2rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--red-light);
        }

        .nav-links { display: flex; gap: 0; }

        .nav-links a {
            color: var(--muted);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0 1.25rem;
            height: 56px;
            display: flex;
            align-items: center;
            border-bottom: 2px solid transparent;
            transition: color 0.2s, border-color 0.2s;
        }

        .nav-links a:hover { color: var(--text); }
        .nav-links a.active { color: var(--red-light); border-bottom-color: var(--red); }

        .page-content {
            max-width: 480px;
            margin: 0 auto;
            padding: 4.5rem 1.5rem 5rem;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .tag {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tag::before {
            content: '';
            display: block;
            width: 24px;
            height: 2px;
            background: var(--red);
        }

        .page-header {
            margin-bottom: 2rem;
            text-align: left;
        }

        .page-header h1 {
            font-family: 'Rajdhani', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.01em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .page-header h1 em {
            font-style: normal;
            color: var(--red-light);
        }

        .page-header p {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .alert-strip {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            background: rgba(127,29,29,0.2);
            border: 1px solid var(--border-hot);
            border-radius: 4px;
            padding: 0.9rem 1.25rem;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            line-height: 1.5;
            color: #fca5a5;
        }

        .alert-strip .icon {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .login-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .card-toolbar {
            padding: 1rem 1.75rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--bg3);
        }

        .toolbar-title {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text);
        }

        form {
            padding: 2rem 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        label {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--red-light);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            background: var(--bg3);
            border: 1px solid var(--border);
            color: var(--text);
            padding: 0.85rem 1rem;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: var(--red);
            box-shadow: 0 0 0 1px var(--red);
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: var(--red);
            color: #fff;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.9rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            background: var(--red-dim);
            transform: translateY(-1px);
        }

        footer {
            height: 48px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            color: var(--muted);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            background: var(--bg);
        }

        @media (max-width: 768px) {
            nav { padding: 0 1.25rem; }
            .page-content { padding: 2.5rem 1.25rem; }
        }
    </style>
</head>
<body>

<nav>
    <span class="nav-logo">MinSU // Portal</span>
    <div class="nav-links">
        <a href="<?=site_url('student')?>">Home</a>
        <a href="<?=site_url('student/profile')?>">Profile</a>
        <a href="<?=site_url('users')?>">Users</a>
        <a href="<?=site_url('products')?>">Products</a>
    </div>
</nav>

<div class="page-content">
    <div class="tag">AUTHENTICATION // ACCESS CONTROL</div>

    <div class="page-header">
        <h1>PORTAL <em>LOGIN</em></h1>
        <p>Authenticate with administrative credentials to access product management.</p>
    </div>

    <?php if (!empty($auth_error)): ?>
        <div class="alert-strip">
            <span class="icon">🚫</span>
            <div><?= htmlspecialchars($auth_error); ?></div>
        </div>
    <?php endif; ?>

    <div class="login-card">
        <div class="card-toolbar">
            <span class="toolbar-title">Admin Credentials</span>
        </div>

        <form action="<?=site_url('authenticate')?>" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="admin" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Sign In →</button>
        </form>
    </div>
</div>

<footer>MinSU Student Portal &copy; 2024 &nbsp;·&nbsp; Powered by LavaLust</footer>

</body>
</html>
