<?php

return
[
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'active' => '/',
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'categories.index',
        'title' => 'Categories',
        'active' => 'categories.*',
    ],
    [
        'icon' => 'fas fa-tags nav-icon',
        'route' => 'products.index',
        'title' => 'Products',
        'active' => 'products.*',
    ],

];
