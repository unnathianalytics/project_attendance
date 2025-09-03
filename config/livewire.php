<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    |
    | This value sets the root namespace for Livewire component classes.
    |
    */

    'class_namespace' => 'App\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This value is the path where Livewire will look for component views.
    |
    */

    'view_path' => resource_path('views/livewire'),

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | This value is the default layout that Livewire components will be
    | wrapped in when rendered via routes.
    |
    */

    'layout' => 'components.layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Asset URL
    |--------------------------------------------------------------------------
    |
    | This is used to generate the URL to Livewire’s JavaScript assets.
    | Keep it null so Laravel uses APP_URL automatically.
    |
    */

    'asset_url' => null,

    /*
    |--------------------------------------------------------------------------
    | Livewire Update URI
    |--------------------------------------------------------------------------
    |
    | Leave null so Livewire auto-prepends your subfolder (from APP_URL).
    | Example:
    |   APP_URL = https://example.com/siteTrackr
    |   => /siteTrackr/livewire/update
    |
    */

    'update_route' => null,

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    */

    'temporary_file_upload' => [
        'disk' => null,
        'rules' => null,
        'directory' => null,
        'middleware' => 'throttle:60,1',
        'preview_mimes' => [
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'text/plain',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Legacy Model Binding
    |--------------------------------------------------------------------------
    */

    'legacy_model_binding' => false,
];
