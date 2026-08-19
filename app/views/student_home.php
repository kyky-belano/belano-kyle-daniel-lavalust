<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal – Kyle Daniel Belano</title>
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

        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: calc(100vh - 56px - 48px);
        }

        .hero-left {
            padding: 5rem 3rem 5rem 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-right: 1px solid var(--border);
        }

        .tag {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--red);
            margin-bottom: 1.5rem;
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

        .hero-left h1 {
            font-family: 'Rajdhani', sans-serif;
            font-size: 4.5rem;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.01em;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
        }

        .hero-left h1 em {
            font-style: normal;
            color: var(--red-light);
        }

        .hero-left p {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.7;
            max-width: 380px;
            margin-bottom: 2.5rem;
        }

        .alert-strip {
            display: none;
            align-items: flex-start;
            gap: 0.75rem;
            background: rgba(127,29,29,0.15);
            border: 1px solid var(--border-hot);
            border-radius: 4px;
            padding: 1rem 1.25rem;
            margin-bottom: 2rem;
            font-size: 0.85rem;
            line-height: 1.5;
            color: #fca5a5;
        }

        .alert-strip.show { display: flex; }

        .alert-strip .icon { font-size: 1.1rem; flex-shrink: 0; margin-top: 1px; }

        .alert-strip strong { display: block; color: var(--red-light); margin-bottom: 0.2rem; font-size: 0.8rem; letter-spacing: 0.04em; text-transform: uppercase; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: var(--red);
            color: #fff;
            text-decoration: none;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.85rem 2rem;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            align-self: flex-start;
        }

        .btn:hover { background: var(--red-dim); transform: translateY(-1px); }

        .btn .arrow { transition: transform 0.2s; }
        .btn:hover .arrow { transform: translateX(4px); }

        .hero-right {
            background: var(--bg2);
            padding: 5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0;
        }

        .stat-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.35rem;
        }

        .stat-value {
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .stat-value:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }

        .stat-value.highlight { color: var(--red-light); }

        footer {
            height: 48px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            color: var(--muted);
            letter-spacing: 0.04em;
        }

        @media (max-width: 768px) {
            .hero { grid-template-columns: 1fr; }
            .hero-left { padding: 3rem 1.5rem; border-right: none; border-bottom: 1px solid var(--border); }
            .hero-left h1 { font-size: 3rem; }
            .hero-right { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

<nav>
    <span class="nav-logo">MinSU // Portal</span>
    <div class="nav-links">
        <a href="<?=site_url('student')?>" class="active">Home</a>
        <a href="<?=site_url('student/profile')?>">Profile</a>
    </div>
</nav>

<main class="hero">
    <div class="hero-left">

        <?php
        if (session_status() === PHP_SESSION_NONE) session_start();
        $blocked = !empty($_SESSION['blocked']);
        unset($_SESSION['blocked']);
        ?>
        <div class="alert-strip <?= $blocked ? 'show' : '' ?>">
            <span class="icon">🚫</span>
            <div>
                <strong>Access Denied — StudentMiddleware</strong>
                Hold up! You don't have clearance to view the student profile. Session access not granted. Visit the home page first.
            </div>
        </div>

        <div class="tag">Student Portal</div>

        <h1>Student<br><em>Info</em></h1>

        <p>This is the student home page of Kyle Daniel Belano — 3rd Year BSIT at MinSU Calapan. Click the button below to view the full student profile.</p>

        <a href="<?=site_url('student/profile')?>" class="btn">
            View Profile <span class="arrow">→</span>
        </a>

    </div>

    <div class="hero-right">
        <div class="stat-label">Student ID</div>
        <div class="stat-value highlight">MCC2024-00068</div>

        <div class="stat-label">Full Name</div>
        <div class="stat-value">Kyle Daniel Belano</div>

        <div class="stat-label">School</div>
        <div class="stat-value">MinSU Calapan</div>

        <div class="stat-label">Active Route</div>
        <div class="stat-value">/student → StudentController::index</div>
    </div>
</main>

<footer>MinSU Student Portal &copy; 2024 &nbsp;·&nbsp; Powered by LavaLust</footer>

</body>
</html>
