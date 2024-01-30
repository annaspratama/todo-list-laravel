<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Home redirect for existing user.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function home(Request $request): RedirectResponse
    {
        if ($request->session()->exists(key: 'username')) {
            return redirect(to: '/todolist');
        } else {
            return redirect(to: '/login');
        }
    }
}
