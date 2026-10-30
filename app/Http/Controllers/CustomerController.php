<?php

namespace App\Http\Controllers;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = [
            ['id' => 'CUS-1001', 'name' => 'Alicia Reyes', 'email' => 'alicia.reyes@example.com', 'status' => 'Active', 'joined' => 'Jan 12, 2026'],
            ['id' => 'CUS-1002', 'name' => 'Brandon Cruz', 'email' => 'brandon.cruz@example.com', 'status' => 'Active', 'joined' => 'Feb 04, 2026'],
            ['id' => 'CUS-1003', 'name' => 'Camille Santos', 'email' => 'camille.santos@example.com', 'status' => 'Pending', 'joined' => 'Mar 18, 2026'],
            ['id' => 'CUS-1004', 'name' => 'Daniel Flores', 'email' => 'daniel.flores@example.com', 'status' => 'Active', 'joined' => 'Apr 22, 2026'],
            ['id' => 'CUS-1005', 'name' => 'Elena Navarro', 'email' => 'elena.navarro@example.com', 'status' => 'Inactive', 'joined' => 'May 09, 2026'],
        ];

        $data = ['page' => 'customers', 'title' => 'Customer Accounts', 'subtitle' => 'Manage customers using a temporary static PHP array.', 'records' => $customers];
        return function_exists('view') ? view('accounts.customers', $data) : $data;
    }
}
