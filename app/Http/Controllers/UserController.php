<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function index()
    {
        $users = [
            ['id' => 'USR-2001', 'name' => 'Mark Garcia', 'email' => 'mark.garcia@example.com', 'role' => 'Administrator', 'status' => 'Online'],
            ['id' => 'USR-2002', 'name' => 'Sarah Lim', 'email' => 'sarah.lim@example.com', 'role' => 'Sales Staff', 'status' => 'Online'],
            ['id' => 'USR-2003', 'name' => 'Jonas Villanueva', 'email' => 'jonas.villanueva@example.com', 'role' => 'Cashier', 'status' => 'Away'],
            ['id' => 'USR-2004', 'name' => 'Nicole Tan', 'email' => 'nicole.tan@example.com', 'role' => 'Sales Staff', 'status' => 'Offline'],
            ['id' => 'USR-2005', 'name' => 'Paolo Mendoza', 'email' => 'paolo.mendoza@example.com', 'role' => 'Manager', 'status' => 'Online'],
        ];

        $data = ['page' => 'users', 'title' => 'User Accounts', 'subtitle' => 'Review system users using a temporary static PHP array.', 'records' => $users];
        return function_exists('view') ? view('accounts.users', $data) : $data;
    }
}
