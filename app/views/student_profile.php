<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile – Kyle Daniel Belano</title>
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

        .layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: calc(100vh - 56px - 48px);
        }

        .sidebar {
            background: var(--bg2);
            border-right: 1px solid var(--border);
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 4px;
            background: var(--bg3);
            border: 2px solid var(--border-hot);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Rajdhani', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--red-light);
            margin-bottom: 1.25rem;
            flex-shrink: 0;
        }

        .sidebar-name {
            font-family: 'Rajdhani', sans-serif;
            font-size: 1.35rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            line-height: 1.1;
            margin-bottom: 0.3rem;
        }

        .sidebar-id {
            font-size: 0.75rem;
            color: var(--red-light);
            font-family: monospace;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-item:last-child { border-bottom: none; }

        .sidebar-item .key {
            font-size: 0.65rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 0.2rem;
        }

        .sidebar-item .val {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .main {
            padding: 2.5rem 3rem;
            overflow-y: auto;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            font-family: 'Rajdhani', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .section-header::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2.5rem;
            font-size: 0.9rem;
        }

        .info-table tr {
            border-bottom: 1px solid var(--border);
        }

        .info-table tr:last-child { border-bottom: none; }

        .info-table td {
            padding: 0.85rem 0;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 160px;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            padding-right: 1.5rem;
            padding-top: 1rem;
        }

        .info-table td:last-child {
            font-weight: 500;
            color: var(--text);
        }

        .bio-block {
            background: var(--bg2);
            border-left: 3px solid var(--red);
            padding: 1.25rem 1.5rem;
            border-radius: 0 4px 4px 0;
            font-size: 0.9rem;
            line-height: 1.8;
            color: #c4c4c4;
            margin-bottom: 2.5rem;
        }

        .social-row {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 2.5rem;
        }

        .social-tag {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-hot);
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--red-light);
            background: rgba(220,38,38,0.05);
        }

        .back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 600;
            color: var(--muted);
            text-decoration: none;
            font-family: 'Rajdhani', sans-serif;
            transition: color 0.2s;
        }

        .back:hover { color: var(--red-light); }

        .middleware-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(220,38,38,0.08);
            border: 1px solid var(--border-hot);
            color: var(--red-light);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.3rem 0.75rem;
            margin-bottom: 2rem;
        }

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
            .layout { grid-template-columns: 1fr; }
            .sidebar { border-right: none; border-bottom: 1px solid var(--border); }
            .main { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

<nav>
    <span class="nav-logo">MinSU // Portal</span>
    <div class="nav-links">
        <a href="<?=site_url('student')?>">Home</a>
        <a href="<?=site_url('student/profile')?>" class="active">Profile</a>
    </div>
</nav>

<div class="layout">

    <aside class="sidebar">
        <div class="avatar">KD</div>
        <div class="sidebar-name"><?= htmlspecialchars($name) ?></div>
        <div class="sidebar-id"><?= htmlspecialchars($student_id) ?></div>

        <div class="sidebar-item">
            <div class="key">Course</div>
            <div class="val"><?= htmlspecialchars($course) ?></div>
        </div>
        <div class="sidebar-item">
            <div class="key">Section</div>
            <div class="val"><?= htmlspecialchars($section) ?></div>
        </div>
        <div class="sidebar-item">
            <div class="key">Year</div>
            <div class="val"><?= htmlspecialchars($year) ?></div>
        </div>
        <div class="sidebar-item">
            <div class="key">Contact</div>
            <div class="val"><?= htmlspecialchars($contact) ?></div>
        </div>
        <div class="sidebar-item">
            <div class="key">Skills</div>
            <div class="val"><?= htmlspecialchars($skills) ?></div>
        </div>
        <div class="sidebar-item">
            <div class="key">Hobbies</div>
            <div class="val"><?= htmlspecialchars($hobbies) ?></div>
        </div>
    </aside>

    <main class="main">

        <div class="middleware-badge">✓ StudentMiddleware Passed</div>

        <div class="section-header"><h2>Student Information</h2></div>

        <table class="info-table">
            <tr>
                <td>Student ID</td>
                <td><?= htmlspecialchars($student_id) ?></td>
            </tr>
            <tr>
                <td>Full Name</td>
                <td><?= htmlspecialchars($name) ?></td>
            </tr>
            <tr>
                <td>Course</td>
                <td><?= htmlspecialchars($course) ?></td>
            </tr>
            <tr>
                <td>Year Level</td>
                <td><?= htmlspecialchars($year) ?></td>
            </tr>
            <tr>
                <td>Section</td>
                <td><?= htmlspecialchars($section) ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?= htmlspecialchars($email) ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?= htmlspecialchars($address) ?></td>
            </tr>
        </table>

        <div class="section-header"><h2>About</h2></div>
        <div class="bio-block"><?= htmlspecialchars($bio) ?></div>

        <div class="section-header"><h2>Social Media</h2></div>
        <div class="social-row">
            <span class="social-tag">📸 Instagram: @<?= htmlspecialchars($instagram) ?></span>
            <span class="social-tag">📘 Facebook: <?= htmlspecialchars($facebook) ?></span>
        </div>

        <a href="<?=site_url('student')?>" class="back">← Back to Home</a>

    </main>

</div>

<footer>MinSU Student Portal &copy; 2024 &nbsp;·&nbsp; Powered by LavaLust</footer>

</body>
</html>
