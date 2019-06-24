<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Kartu Pengawasan',

    'title_prefix' => '',

    'title_postfix' => ' - Kartu Pengawasan',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Kartu</b> Pengawasan',

    'logo_mini' => '<b>K</b>P',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MAIN NAVIGATION',
        [
            'text' => 'Dashboard',
            'url'  => '/home',
            'icon' => 'tachometer',
            // 'can'  => 'manage-blog',
        ],
        [
            'text'    => 'Master Data',
            'icon'    => 'database',
            'submenu' => [
                [
                    'text' => 'Merk',
                    'url'  => '/m/merk',
                    // 'can'  => 'manage-blog',
                ],
                [
                    'text' => 'Jenis Kendaraan',
                    'url'  => '/m/jk',
                    // 'can'  => 'manage-blog',
                ],
                // [
                //     'text' => 'Kategori Perusahaan',
                //     'url'  => '/m/katperusahaan',
                //     // 'can'  => 'manage-blog',
                // ],
                [
                    'text' => 'Perusahaan',
                    'url'  => '/m/perusahaan',
                    // 'can'  => 'manage-blog',
                    'submenu' => [
                      [
                        'text' => 'Angkutan Sewa Khusus',
                        'url'  => '/m/perusahaan',
                        // 'can'  => 'manage-blog',
                      ],
                      [
                        'text' => 'Taksi',
                        'url'  => '/m/perusahaantaksi',
                        // 'can'  => 'manage-blog',
                      ],
                    ],
                ],
                // [
                //     'text' => 'Status Awal Kendaraan',
                //     'url'  => '/m/sak',
                //     // 'can'  => 'manage-blog',
                // ],
                [
                    'text' => 'Wilayah',
                    'url'  => '/m/wilayah',
                    // 'can'  => 'manage-blog',
                ],
                [
                    'text' => 'Warna',
                    'url'  => '/m/warna',
                    // 'can'  => 'manage-blog',
                ],
            ],
        ],
        [
            'text'    => 'Settting',
            'icon'    => 'cogs',
            'submenu' => [
                [
                    'text' => 'Kartu Pengawasan',
                    'url'  => '/m/setting',
                    // 'can'  => 'manage-blog',
                ],
                [
                    'text' => 'Pasal Peraturan Mentri',
                    'url'  => '/m/pasal',
                    // 'can'  => 'manage-blog',
                ],
            ],
        ],
        // [
        //     'text' => 'RBAC',
        //     'url'  => 'admin/settings',
        //     'icon' => 'users',
        //     'submenu' => [
        //         [
        //             'text' => 'User',
        //             'url'  => '/rbac/user',
        //             // 'can'  => 'manage-blog',
        //         ],
        //         [
        //             'text' => 'Role',
        //             'url'  => '/rbac/role',
        //             // 'can'  => 'manage-blog',
        //         ],
        //     ],
        // ],
        [
            'text' => 'Perubahan Sifat',
            'url'  => '/perubahansifat',
            'icon' => 'refresh',
            // 'can'  => 'manage-blog',
        ],
        [
            'text' => 'SK KP',
            'url'  => '/ask/kpsk',
            'icon' => 'id-card',
            // 'can'  => 'manage-blog',
        ],
        [
            'text' => 'Kartu Pengawasan',
            'icon' => 'id-card',
            'submenu' => [
                [
                    'text' => 'Angkutan Sewa Khusus',
                    'url'  => '/kp/ask',
                    // 'can'  => 'manage-blog',
                ],
                [
                    'text' => 'Taksi',
                    'url'  => '/kp/taksi',
                    // 'can'  => 'manage-blog',
                ],
            ],
        ],
        [
            'text' => 'Peremajaan',
            'icon' => 'repeat',
            // 'can'  => 'manage-blog',
            'submenu' => [
              [
                  'text' => 'Angkutan Sewa Khusus',
                  'url'  => '/peremajaan/ask',
                  // 'can'  => 'manage-blog',
              ],
              [
                  'text' => 'Taksi',
                  'url'  => '/peremajaan/taksi',
                  // 'can'  => 'manage-blog',
              ],
            ],
        ],
        [
            'text' => 'Perpanjangan',
            'icon' => 'money',
            // 'can'  => 'manage-blog',
            'submenu' => [
              [
                  'text' => 'Angkutan Sewa Khusus',
                  'url'  => '/perpanjangan/ask',
                  // 'can'  => 'manage-blog',
              ],
              [
                  'text' => 'Taksi',
                  'url'  => '/perpanjangan/taksi',
                  // 'can'  => 'manage-blog',
              ],
            ],
        ],
        [
          'text' => 'Laporan',
          'icon' => 'book',
          // 'can'  => 'manage-blog',
          'submenu' => [
            [
                'text' => 'Angkutan Sewa Khusus',
                'url'  => '/laporan/ask',
                // 'can'  => 'manage-blog',
            ],
            [
                'text' => 'Taksi',
                'url'  => '/laporan/taksi',
                // 'can'  => 'manage-blog',
            ],
          ],
        ],
        // [
        //     'text' => 'Laporan',
        //     'url'  => 'admin/pages',
        //     'icon' => 'book',
        //     'submenu' => [
        //         [
        //             'text' => 'Daftar Angkutan Sewa',
        //             'url'  => '#',
        //             // 'can'  => 'manage-blog',
        //         ],
        //         [
        //             'text' => 'Perpanjangan',
        //             'url'  => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Jatuh Tempo',
        //                     'url'  => '#',
        //                     // 'can'  => 'manage-blog',
        //                 ],
        //                 [
        //                     'text' => 'Lewat Jatuh Tempo',
        //                     'url'  => '#',
        //                     // 'can'  => 'manage-blog',
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'Pendapatan',
        //             'url'  => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Harian',
        //                     'url'  => '#',
        //                     // 'can'  => 'manage-blog',
        //                 ],
        //                 [
        //                     'text' => 'Mingguan',
        //                     'url'  => '#',
        //                     // 'can'  => 'manage-blog',
        //                 ],
        //                 [
        //                     'text' => 'Bulanan',
        //                     'url'  => '#',
        //                     // 'can'  => 'manage-blog',
        //                 ],
        //                 [
        //                     'text' => 'Perpanjangan',
        //                     'url'  => '#',
        //                     // 'can'  => 'manage-blog',
        //                 ],
        //                 [
        //                     'text' => 'Registrasi',
        //                     'url'  => '#',
        //                     // 'can'  => 'manage-blog',
        //                 ],
        //             ],
        //         ],
        //     ],
        // ],
        // [
        //     'text' => 'Ganti Password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'lock',
        //     // 'can'  => 'manage-blog',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
