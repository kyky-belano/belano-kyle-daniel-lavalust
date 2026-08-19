<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['student_access'] = true;
        $this->call->view('student_home');
    }

    public function profile()
    {
        $student = [
            'student_id' => 'MCC2024-00068',
            'name'       => 'Kyle Daniel Belano',
            'course'     => 'BS Information Technology',
            'year'       => '3rd Year',
            'section'    => 'BSIT-3-F2',
            'email'      => 'kyle.belano@minsu.edu.ph',
            'address'    => 'Tacligan, San Teodoro, Oriental Mindoro',
            'contact'    => '09940204184',
            'skills'     => 'Playing Games',
            'hobbies'    => 'Watching Anime',
            'bio'        => "Hey! I'm Kyle Daniel, a 3rd-year IT major at MinSU Calapan. When I'm not handling tech coursework, you'll usually find me clutching games or binge-watching my favorite anime series.",
            'instagram'  => 'kyyy_el',
            'facebook'   => 'Kyle Daniel Belano',
        ];

        $this->call->view('student_profile', $student);
    }
}
?>
