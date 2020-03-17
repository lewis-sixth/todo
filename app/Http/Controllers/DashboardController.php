<?php

namespace App\Http\Controllers;

use App\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $self = Auth::user();

        return Inertia::render('Dashboard', [
            'self' => $self->load('tasks'),
            'users' => User::where('email', '!=', $self->email)->with('tasks')->get()
        ]);
    }
}
