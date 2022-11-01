<?php

return
    [
        [
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'route' => 'dashboard.admin',
            'title' => 'Dashboard',
            'active' => '/',
        ],
        [
            'icon' => 'fas fa-tags nav-icon',
            'route' => 'dashboard.categories.index',
            'title' => 'Categories',
            'active' => 'categories.*',
            'permission' => 'categories.index',
        ],
        [
            'icon' => 'fas fa-tags nav-icon',
            'route' => 'dashboard.products.index',
            'title' => 'Products',
            'active' => 'products.*',
            'permission' => 'products.index',
        ],
        [
            'icon' => 'fas fa-tags nav-icon',
            'route' => 'dashboard.orders.index',
            'title' => 'Orders',
            'active' => 'orders.*',
            'permission' => 'orders.index',
        ],
        [
            'icon' => 'fas fa-tags nav-icon',
            'route' => 'dashboard.roles.index',
            'title' => 'Roles',
            'active' => 'roles.*',
            'permission' => 'roles.index',
        ],

    ];
