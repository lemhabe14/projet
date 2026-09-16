<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var Utilisateur $user */
        $user = Auth::user();

        return view('dashboard-user', [
            'user' => $user,
            'usersCount' => Utilisateur::count(),
        ]);
    }
}