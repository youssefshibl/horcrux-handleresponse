<?php

return [
    'withstatus' => true,
    'default_dirver' => 'default',
    'drivers' => [
        'default' => [
            'status_key' => 'state',
            'reset' => ['number', 'data']
        ],
        'test' => [
            'status_key' => 'status',
            'reset' => ['number', 'youssef']
        ],
    ]
];
