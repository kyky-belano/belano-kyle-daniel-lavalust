<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle($next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            return $next();
        }

        $_SESSION['auth_error'] = 'Access denied. Please log in first.';
        header('Location: ' . site_url('login'));
        exit;
    }
}
