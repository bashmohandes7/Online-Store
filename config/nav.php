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
        ],
        [
            'icon' => 'fas fa-tags nav-icon',
            'route' => 'dashboard.products.index',
            'title' => 'Products',
            'active' => 'products.*',
        ],

    ];
