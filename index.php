<?php
declare(strict_types=1);

require_once __DIR__ . '/app/Http/Controllers/Controller.php';
require_once __DIR__ . '/app/Http/Controllers/PageController.php';
require_once __DIR__ . '/app/Http/Controllers/CustomerController.php';
require_once __DIR__ . '/app/Http/Controllers/UserController.php';

use App\Http\Controllers\PageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$page = trim((string) ($_GET['page'] ?? ''), '/');
$path = $page !== '' ? '/' . $page : (rtrim($path, '/') ?: '/');
$routes = [
    '/' => [PageController::class, 'home'],
    '/about' => [PageController::class, 'about'],
    '/customers' => [CustomerController::class, 'index'],
    '/users' => [UserController::class, 'index'],
];

if (!isset($routes[$path])) {
    http_response_code(404);
    $data = ['page' => '404', 'title' => 'Page not found', 'subtitle' => 'The requested page does not exist.'];
    $content = '<div class="section-head"><div><div class="eyebrow">404 error</div><h1>Page not found</h1><p>The requested page does not exist.</p><a class="button" href="/">Back to dashboard</a></div></div>';
} else {
    [$class, $method] = $routes[$path];
    $data = (new $class())->$method();
    $content = render_page($data);
}

echo render_layout($data, $content);

function esc(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }

function render_page(array $data): string
{
    $page = $data['page'];
    $title = esc($data['title']);
    $subtitle = esc($data['subtitle']);
    if ($page === 'home') {
        return '<section class="hero"><div class="eyebrow">Welcome back</div><h1>Keep every account in view.</h1><p>A focused POS workspace for managing customers and users with clarity. Built as a Laravel MVC foundations application.</p><div class="actions"><a class="button" href="index.php?page=customers">View customers</a><a class="button alt" href="index.php?page=about">About this build</a></div></section><div class="stats"><div class="stat"><small>CUSTOMER ACCOUNTS</small><div class="number">05</div></div><div class="stat"><small>USER ACCOUNTS</small><div class="number">05</div></div><div class="stat"><small>ACTIVE RECORDS</small><div class="number">08</div></div></div>';
    }
    if ($page === 'about') {
        return '<div class="section-head"><div><div class="eyebrow">The build</div><h1>'.$title.'</h1><p>'.$subtitle.'</p></div></div><div class="info-grid"><article class="info-card"><h3>What this activity demonstrates</h3><p>This application rebuilds the POS pages from TFA1 in Laravel. A route selects the controller method, the controller prepares the response, and a Blade view renders the interface.</p><p>Both account pages use a static PHP array as their temporary data source and loop through each record with <strong>@foreach</strong>.</p></article><article class="info-card"><h3>Project map</h3><ul><li><strong>routes/web.php</strong> maps the four pages.</li><li><strong>PageController</strong> handles home and about.</li><li><strong>CustomerController</strong> and <strong>UserController</strong> handle account lists.</li><li><strong>resources/views</strong> contains Blade templates.</li></ul></article></div>';
    }
    $isCustomers = $page === 'customers';
    $heading = $isCustomers ? 'customers' : 'users';
    $headers = $isCustomers ? '<th>Account ID</th><th>Name</th><th>Email</th><th>Status</th><th>Joined</th>' : '<th>Account ID</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th>';
    $rows = '';
    foreach ($data['records'] as $record) {
        $status = strtolower($record['status']);
        $extra = $isCustomers ? '<td><span class="tag '.$status.'">'.esc($record['status']).'</span></td><td class="muted">'.esc($record['joined']).'</td>' : '<td class="muted">'.esc($record['role']).'</td><td><span class="tag '.$status.'">'.esc($record['status']).'</span></td>';
        $rows .= '<tr><td>'.esc($record['id']).'</td><td><strong>'.esc($record['name']).'</strong></td><td class="muted">'.esc($record['email']).'</td>'.$extra.'</tr>';
    }
    $other = $isCustomers ? '/users' : '/customers';
    $otherLabel = $isCustomers ? 'View users' : 'View customers';
    return '<div class="section-head"><div><div class="eyebrow">Accounts / '.$heading.'</div><h1>'.$title.'</h1><p>'.$subtitle.'</p></div><a class="button" href="'.$other.'">'.$otherLabel.'</a></div><div class="table-wrap"><table><thead><tr>'.$headers.'</tr></thead><tbody>'.$rows.'</tbody></table></div><p class="empty-note">Showing '.count($data['records']).' sample records from a static PHP array.</p>';
}

function render_layout(array $data, string $content): string
{
    $page = esc($data['page']); $title = esc($data['title']);
    $nav = function (string $key, string $label, string $href) use ($page): string { $active = $page === $key ? 'active' : ''; return '<a href="'.$href.'" class="'.$active.'"><span class="dot"></span>'.$label.'</a>'; };
    return '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>'.$title.' | POS Command Center</title><link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet"><style>'.css().'</style></head><body><div class="shell"><aside class="sidebar"><div class="brand">POS <span>●</span> COMMAND</div><p class="nav-label">Workspace</p><nav class="nav">'.$nav('home','Dashboard','index.php').$nav('customers','Customers','index.php?page=customers').$nav('users','Users','index.php?page=users').$nav('about','About','index.php?page=about').'</nav><div class="version">LARAVEL FOUNDATIONS<br><span>IT0049 · TFA 5</span></div></aside><main class="main"><div class="topbar"><div class="crumb">POS COMMAND CENTER / <strong>'.strtoupper($page).'</strong></div><div class="profile"><div class="avatar">MG</div>Mark Garcia</div></div>'.$content.'</main></div></body></html>';
}

function css(): string { return file_get_contents(__DIR__.'/public/app.css') ?: ''; }
