<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SessionController extends Controller
{
     public function create(): View
        {
            return view('auth.login');
        }
}
