<?php

return [
    /*
        All the values in "commons" and the different arrays into "elements" may be defined everywhere.
        Those specific for an "elements" tag type will take precedence on those defined in "commons".
    */

    'commons' => [
        'label_width' => '2',
        'input_width' => '10',
    ],

    'elements' => [
        'navbar' => [
            'color' => 'light',
        ],

        'modal' => [
            'buttons' => [
                ['color' => 'secondary', 'label' => 'Close', 'attributes' => ['data-bs-dismiss' => 'modal']]
            ],
        ],

        'form' => [
            'formview' => 'horizontal',
            'method' => 'POST',

            'buttons' => [
                ['color' => 'primary', 'label' => 'Save', 'attributes' => ['type' => 'submit']]
            ]
        ],

        'number' => [
            'step' => 1,
            'min' => PHP_INT_MIN,
            'max' => PHP_INT_MAX,
        ],

        'range' => [
            'step' => 1,
            'min' => PHP_INT_MIN,
            'max' => PHP_INT_MAX,
        ],

        'radios' => [
            'color' => 'outline-primary',
        ],

        'checks' => [
            'color' => 'outline-primary',
        ],

        'tabs' => [
            'tabview' => 'tabs',
        ],

        'tabpane' => [
            'classes' => ['p-3']
        ]
    ],

    'customs' => [
        'deleteform' => [
            'extends' => 'form',
            'params' => [
                'classes' => ['text-center'],
                'method' => 'DELETE',
                'buttons_align' => 'center',
                'buttons' => [['color' => 'danger', 'label' => 'Yes, delete it', 'attributes' => ['type' => 'submit']]]
            ],
        ],
    ],
];
