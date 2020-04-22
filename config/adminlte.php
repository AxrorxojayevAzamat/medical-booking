<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Title
      |--------------------------------------------------------------------------
      |
      | Here you can change the default title of your admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
      |
     */

    'title' => 'Medical Booking',
    'title_prefix' => '',
    'title_postfix' => '',
    /*
      |--------------------------------------------------------------------------
      | Favicon
      |--------------------------------------------------------------------------
      |
      | Here you can activate the favicon.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
      |
     */
    'use_ico_only' => false,
    'use_full_favicon' => false,
    /*
      |--------------------------------------------------------------------------
      | Logo
      |--------------------------------------------------------------------------
      |
      | Here you can change the logo of your admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
      |
     */
    'logo' => '<b>Medical</b> Booking',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Medical Booking',
    /*
      |--------------------------------------------------------------------------
      | User Menu
      |--------------------------------------------------------------------------
      |
      | Here you can activate and change the user menu.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
      |
     */
    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    /*
      |--------------------------------------------------------------------------
      | Layout
      |--------------------------------------------------------------------------
      |
      | Here we change the layout of your admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#65-layout
      |
     */
    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    /*
      |--------------------------------------------------------------------------
      | Extra Classes
      |--------------------------------------------------------------------------
      |
      | Here you can change the look and behavior of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#66-classes
      |
     */
    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_header' => 'container-fluid',
    'classes_content' => 'container-fluid',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand-md',
    'classes_topnav_container' => 'container',
    /*
      |--------------------------------------------------------------------------
      | Sidebar
      |--------------------------------------------------------------------------
      |
      | Here we can modify the sidebar of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#67-sidebar
      |
     */
    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,
    /*
      |--------------------------------------------------------------------------
      | Control Sidebar (Right Sidebar)
      |--------------------------------------------------------------------------
      |
      | Here we can modify the right sidebar aka control sidebar of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#68-control-sidebar-right-sidebar
      |
     */
    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',
    /*
      |--------------------------------------------------------------------------
      | URLs
      |--------------------------------------------------------------------------
      |
      | Here we can modify the url settings of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#69-urls
      |
     */
    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    /*
      |--------------------------------------------------------------------------
      | Laravel Mix
      |--------------------------------------------------------------------------
      |
      | Here we can enable the Laravel Mix option for the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#610-laravel-mix
      |
     */
    'enabled_laravel_mix' => false,
    /*
      |--------------------------------------------------------------------------
      | Menu Items
      |--------------------------------------------------------------------------
      |
      | Here we can modify the sidebar/top navigation of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#611-menu
      |
     */
    'menu' => [
        [
            'text' => 'search',
            'search' => true,
            'topnav' => true,
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        // [
        //     'text'        => 'pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'far fa-fw fa-file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        // ['header' => 'account_settings'],
        // [
        //     'text' => 'profile',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-user',
        // ],
        // [
        //     'text' => 'change_password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        [
            'text' => 'Регионы',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'Список регионов',
                    'url' => 'region/',
                ],
                [
                    'text' => 'Создание нового региона',
                    'url' => 'region/create',
                ],
            ],
        ],
        [
            'text' => 'Врачи',
            'icon' => 'fas fa-fw fa-user',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
            ],
        ],
        [
            'text' => 'Специализации',
            'icon' => 'fas fa-fw fa-share',
            'url' => 'admin/specializations',
//            'submenu' => [
//                [
//                    'text' => 'level_one',
//                    'url'  => '#',
//                ],
//                [
//                    'text'    => 'level_one',
//                    'url'     => '#',
//                ],
//                [
//                    'text' => 'level_one',
//                    'url'  => '#',
//                ],
//            ],
        ],
        [
            'text' => 'Клиники',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
            ],
        ],
        [
            'text' => 'Пользователи',
            'icon' => 'fas fa-fw fa-user',
            'url' => 'admin/users',
//            'submenu' => [
//                [
//                    'text' => 'Пользователи',
//                    'url'  => 'admin/users',
//                ],
//
//                [
//                    'text' => 'level_one',
//                    'url'  => '#',
//                ],
//            ],
        ],
        [
            'text' => 'multilevel',
            'icon' => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
                [
                    'text' => 'level_one',
                    'url' => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url' => '#',
                        ],
                        [
                            'text' => 'level_two',
                            'url' => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url' => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url' => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'level_one',
                    'url' => '#',
                ],
            ],
        ],
    // ['header' => 'labels'],
    // [
    //     'text'       => 'important',
    //     'icon_color' => 'red',
    // ],
    // [
    //     'text'       => 'warning',
    //     'icon_color' => 'yellow',
    // ],
    // [
    //     'text'       => 'information',
    //     'icon_color' => 'aqua',
    // ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Menu Filters
      |--------------------------------------------------------------------------
      |
      | Here we can modify the menu filters of the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#612-menu-filters
      |
     */
    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],
    /*
      |--------------------------------------------------------------------------
      | Plugins Initialization
      |--------------------------------------------------------------------------
      |
      | Here we can modify the plugins used inside the admin panel.
      |
      | For more detailed instructions you can look here:
      | https://github.com/jeroennoten/Laravel-AdminLTE/#613-plugins
      |
     */
    'plugins' => [
        [
            'name' => 'Select2',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '/vendor/select2/js/select2.full.min.js',
                ],
            ],
        ],
        [
            'name' => 'bootstrap4Duallistbox',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
                ],
            ],
        ],
        [
            'name' => 'moment',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/moment/moment.min.js',
                ],
            ],
        ],
        [
            'name' => 'inputmask',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/inputmask/min/jquery.inputmask.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'DateRangePicker',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/daterangepicker/daterangepicker.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/daterangepicker/daterangepicker.js',
                ],
            ],
        ],
        [
            'name' => 'tempusdominus',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                ],
            ],
        ],
        [
            'name' => 'bootstrap-switch',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/bootstrap-switch/js/bootstrap-switch.min.js',
                ],
            ],
        ],
        [
            'name' => 'Select 2 with Bootstrap 4 Theme',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        [
            'name' => 'bootstrap4Duallistbox',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '/vendor/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
                ],
            ],
        ],
        [
            'name' => 'custom',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '/js/custom.js',
                ],
            ],
        ],
    ],
];