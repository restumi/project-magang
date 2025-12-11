<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RoleController extends Controller
{
    public function switchRole(string $role): RedirectResponse
    {
        $allowedRoles = ['user', 'admin', 'super_admin'];

        if(in_array($role, $allowedRoles)){
            $user = auth()->user();
            $user->role = $role;
            $user->save();

            return redirect()->back()->with('success', "Switched to {$role}");
        }

        return redirect()->back()->with('error', 'Invalid user');
    }
}
