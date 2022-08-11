<?php

return [
    'core' => [
        'run_default_migrations' => env('RUN_DEFAULT_MIGRATIONS', false), // Only have this set to true if you don't use Atom CMS
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