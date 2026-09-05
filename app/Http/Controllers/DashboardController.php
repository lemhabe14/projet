<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

       
        $usersCount = Utilisateur::count();

        return view('dashboard', [
            'admin' => $admin,
            'usersCount' => $usersCount,
        ]);
    }
}