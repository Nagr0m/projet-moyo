<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\UserInject;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    use UserInject;

    public function __construct ()
    {
        $this->setUser();
    }

    public function index ()
    {
        return view('teacher.dashboard');
    }
}
