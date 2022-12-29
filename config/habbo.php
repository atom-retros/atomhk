<?php

return [
    'core' => [
        'force_https' => env('FORCE_HTTPS', false), // Only set this to true if your experiencing issues with HTTPs requests
        'using_atom_cms' => env('USING_ATOM_CMS', true), // Only have this set to true if you don't use Atom CMS
    ],

    /**
     * Rcon configuration.
     */
    'rcon' => [
        'host' => env('RCON_HOST', '127.0.0.1'),
        'port' => env('RCON_PORT', 3001),
        'domain' => AF_INET,
        'type' => SOCK_STREAM,
        'protocol' => SOL_TCP,
    ],
];