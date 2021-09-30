<?php
return [


    [
        'name'=>'Loans',
        'url'=>'#',
        'icon'=>'menu-icon fa fa-credit-card',
        'sub_menu'=>[
            // [
            //     'name'=>'Search Client',
            //     'route_name'=>'loans.create',
            //     'icon'=>'menu-icon fa fa-plus',
            //     'permission_name'=>'loans.create',
            // ],
            [
                'name'=>'Loans',
                'route_name'=>'loans.index',
                'icon'=>'menu-icon fa fa-money',
                'permission_name'=>'loans.index',
            ],
            [
                'name'=>'For Approval',
                'route_name'=>'loans.for-approval',
                'icon'=>'menu-icon fa fa-users',
                'permission_name'=>'loans.for-approval',
            ],
            [
                'name'=>'Approved',
                'route_name'=>'loans.approved',
                'icon'=>'menu-icon fa fa-money',
                'permission_name'=>'loans.approved',
            ],
            [
                'name'=>'For releasing',
                'route_name'=>'loans.for-releasing',
                'icon'=>'menu-icon fa fa-money',
                'permission_name'=>'loans.for-releasing',
            ],
            [
                'name'=>'Released',
                'route_name'=>'loans.released',
                'icon'=>'menu-icon fa fa-money',
                'permission_name'=>'loans.released',
            ]
        ],
        'permissions_name'=>'clients.index|loans.index',
    ],
    // [
    //     'name'=>'Payments & Remits',
    //     'route_name'=>'remittances.index',
    //     'icon'=>'menu-icon fa fa-money',
    //     'sub_menu'=>[],
    //     'permissions_name'=>'remittances.index',
    // ],
    [
        'name'=>'Expenses',
        'route_name'=>'expenses.index',
        'icon'=>'menu-icon fa fa-credit-card',
        'sub_menu'=>[],
        'permissions_name'=>'expenses.index',
    ],
    // [
    //     'name'=>'Printables',
    //     'url'=>'#',
    //     'icon'=>'menu-icon fa  fa-bar-chart-o',
    //     'sub_menu'=>[
    //         [
    //             'name'=>'Collection Schedule',
    //             'route_name'=>'reports.collection_schedule',
    //             'icon'=>'menu-icon fa fa-file',
    //             'permission_name'=>'reports.index',
    //         ],

    //         [
    //             'name'=>'Closing Report',
    //             'route_name'=>'reports.closing_report',
    //             'icon'=>'menu-icon fa fa-file',
    //             'permission_name'=>'reports.index',
    //         ],

    //         [
    //             'name'=>'Collection Report',
    //             'route_name'=>'reports.cr',
    //             'icon'=>'menu-icon fa fa-file',
    //             'permission_name'=>'reports.index',
    //         ],
    //         [
    //             'name'=>'Sales Monitoring Report',
    //             'route_name'=>'reports.sr',
    //             'icon'=>'menu-icon fa fa-file',
    //             'permission_name'=>'reports.index',
    //         ],
    //         [
    //             'name'=>'Loan Report',
    //             'route_name'=>'reports.lr',
    //             'icon'=>'menu-icon fa fa-file',
    //             'permission_name'=>'reports.index',
    //         ],
    //         [
    //             'name'=>'Withdrawal Report',
    //             'route_name'=>'reports.wr',
    //             'icon'=>'menu-icon fa fa-file',
    //             'permission_name'=>'reports.index',
    //         ],
    //         [
    //             'name'=>'Expenses Report',
    //             'route_name'=>'reports.er',
    //             'icon'=>'menu-icon fa fa-file',
    //             'permission_name'=>'reports.index',
    //         ],
    //     ],
    //     'permissions_name'=>'reports.index',
    // ],

    // [
    //     'name'=>'References',
    //     'route_name'=>'references.index',
    //     'icon'=>'menu-icon fa fa-list-alt',
    //     'sub_menu'=>[],
    //     'permissions_name'=>'branches.index|areas.index|categories.index|terms.index|payment-modes.index|charges.index',
    // ],

    [
        'name'=>'Libraries',
        'url'=>'#',
        'icon'=>'menu-icon fa  fa-list',
        'sub_menu'=>[
            // [
            //     'name'=>'Branches',
            //     'route_name'=>'branches.index',
            //     'icon'=>'menu-icon fa fa-file',
            //     'permission_name'=>'branches.index',
            // ],
            [
                'name'=>'Areas',
                'route_name'=>'areas.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'areas.index',
            ],
            // [
            //     'name'=>'Categories',
            //     'route_name'=>'categories.index',
            //     'icon'=>'menu-icon fa fa-file',
            //     'permission_name'=>'categories.index',
            // ],
            // [
            //     'name'=>'Terms',
            //     'route_name'=>'terms.index',
            //     'icon'=>'menu-icon fa fa-file',
            //     'permission_name'=>'terms.index',
            // ],
            // [
            //     'name'=>'Payment Modes',
            //     'route_name'=>'payment-modes.index',
            //     'icon'=>'menu-icon fa fa-file',
            //     'permission_name'=>'payment-modes.index',
            // ],
            [
                'name'=>'Charges',
                'route_name'=>'charges.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'charges.index',
            ],
            [
                'name'=>'Relationships',
                'route_name'=>'relationships.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'relationships.index',
            ],
            // [
            //     'name'=>'Expenses Report',
            //     'route_name'=>'reports.er',
            //     'icon'=>'menu-icon fa fa-file',
            //     'permission_name'=>'reports.index',
            // ],
        ],
        'permissions_name'=>'branches.index|areas.index|categories.index|terms.index|payment-modes.index|charges.index',
    ],

    [
        'name'=>'Administration',
        'url'=>'#',
        'icon'=>'menu-icon fa  fa-list',
        'sub_menu'=>[
            [
                'name'=>'Employees',
                'route_name'=>'employees.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'employees.index',
            ],
            [
                'name'=>'Users',
                'route_name'=>'users.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'users.index',
            ],
            [
                'name'=>'Roles and Permissions',
                'route_name'=>'roles.index',
                'icon'=>'menu-icon fa fa-file',
                'permission_name'=>'roles.index',
            ]
        ],
        'permissions_name'=>'users.index|employees.index',
    ]
];
?>
