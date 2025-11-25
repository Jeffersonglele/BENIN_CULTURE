<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function index()
    {
        $loginHistories = auth()->user()->loginHistories()
            ->latest('login_at')
            ->take(10)
            ->get();

        return view('dashboard', compact('loginHistories'));
    }
}
