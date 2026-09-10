<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Users – Kyle Daniel Belano') ?></title>
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
            max-width: 1100px;
            margin: 0 auto;
            padding: 3.5rem 2rem 5rem;
            width: 100%;
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
            margin-bottom: 2.5rem;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .page-header h1 {
            font-family: 'Rajdhani', sans-serif;
            font-size: 3.2rem;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.01em;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
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

        .count-badge {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.5rem 1.25rem;
            border-radius: 4px;
            background: rgba(220,38,38,0.12);
            border: 1px solid var(--border-hot);
            color: var(--red-light);
            white-space: nowrap;
        }

        .table-card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 4px;
            overflow: hidden;
        }

        .table-toolbar {
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

        .toolbar-meta {
            font-size: 0.75rem;
            color: var(--muted);
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            font-size: 0.9rem;
        }

        thead {
            background: rgba(24,24,24,0.6);
            border-bottom: 1px solid var(--border);
        }

        thead th {
            font-family: 'Rajdhani', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--red-light);
            padding: 1rem 1.75rem;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(220,38,38,0.06);
        }

        tbody td {
            padding: 1.15rem 1.75rem;
            vertical-align: middle;
            color: var(--text);
        }

        .user-id {
            font-family: monospace;
            font-size: 0.8rem;
            color: var(--red-light);
            background: var(--bg3);
            border: 1px solid var(--border);
            padding: 0.2rem 0.6rem;
            border-radius: 3px;
            display: inline-block;
        }

        .user-name {
            font-weight: 500;
            color: #fff;
        }

        .user-email {
            color: #d1d5db;
        }

        .user-username {
            font-family: monospace;
            font-size: 0.85rem;
            color: var(--red-light);
        }

        .empty-row {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--muted);
            font-size: 0.95rem;
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
            .page-content { padding: 2rem 1.25rem; }
            .page-header h1 { font-size: 2.2rem; }
            tbody td, thead th { padding: 0.85rem 1rem; }
        }
    </style>
</head>
<body>

<nav>
    <span class="nav-logo">MinSU // Portal</span>
    <div class="nav-links">
        <a href="<?=site_url('student')?>">Home</a>
        <a href="<?=site_url('student/profile')?>">Profile</a>
        <a href="<?=site_url('users')?>" class="active">Users</a>
    </div>
</nav>

<div class="page-content">
    <div class="tag">DATABASE // MYDB.USERS</div>

    <div class="page-header">
        <div>
            <h1>USERS <em>DIRECTORY</em></h1>
            <p>Database records retrieved dynamically from the MySQL users table via UsersModel.</p>
        </div>
        <div class="count-badge">
            <?= !empty($users) ? count($users) : 0; ?> Total Records
        </div>
    </div>

    <div class="table-card">
        <div class="table-toolbar">
            <span class="toolbar-title">Registered Accounts</span>
            <span class="toolbar-meta">Table: users</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><span class="user-id">#<?= htmlspecialchars($user['id']); ?></span></td>
                                <td class="user-name"><?= htmlspecialchars($user['firstname']); ?></td>
                                <td><?= htmlspecialchars($user['lastname']); ?></td>
                                <td class="user-email"><?= htmlspecialchars($user['email']); ?></td>
                                <td><span class="user-username">@<?= htmlspecialchars($user['username']); ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty-row">No records found in database table 'users'.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>MinSU Student Portal &copy; 2024 &nbsp;·&nbsp; Powered by LavaLust</footer>

</body>
</html>
