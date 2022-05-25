<?php

return [
    'admin' => [
        'auth' => config('administratix.views.prefix') . 'layouts.auth',
        'guest' => config('administratix.views.prefix') . 'layouts.guest',
        'components' => [
            'navbar' => '',
            'sidebar' => '',
            'footer' => ''
        ]
    ]
];