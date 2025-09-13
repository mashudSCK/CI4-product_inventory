<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }
    public function lectureNotes()
    {
        $data = [
            'title'   => 'Lecture Notes',
            'heading' => 'Welcome to CodeIgniter 4',
            'message' => 'This is your first custom page in CodeIgniter 4!',
        ];
        return view('lecture_notes', $data);
    }
}
