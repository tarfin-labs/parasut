<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Client ID
    |--------------------------------------------------------------------------
    |
    | Client ID for your parasut.com account.
    |
    */

    'client_id' => env('PARASUT_CLIENT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Client Secret
    |--------------------------------------------------------------------------
    |
    | Client secret for your parasut.com account.
    |
    */

    'client_secret' => env('PARASUT_CLIENT_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Username
    |--------------------------------------------------------------------------
    |
    | Username for your parasut.com account.
    |
    */

    'username' => env('PARASUT_USERNAME'),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Password for your parasut.com account.
    |
    */

    'password' => env('PARASUT_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Company ID
    |--------------------------------------------------------------------------
    |
    | Company ID for your parasut.com account
    |
    */

    'company_id' => env('PARASUT_COMPANY_ID'),

    /*
    |--------------------------------------------------------------------------
    | Grant Type
    |--------------------------------------------------------------------------
    |
    | Grant type for API authentication.
    |
    | Available types: "password", "authorization_code"
    |
    | Default: "password"
    |
    | Note: "authorization_code" method needs a registered custom
    |       "redirect_url" from parasut.com.
    |
    */

    'grant_type' => env('PARASUT_GRANT_TYPE', 'password'),

    /*
    |--------------------------------------------------------------------------
    | Redirect URI
    |--------------------------------------------------------------------------
    |
    | Redirect URI for your parasut.com account.
    |
    | Default: "urn:ietf:wg:oauth:2.0:oob"
    |
    */

    'redirect_uri' => env('PARASUT_REDIRECT_URI', 'urn:ietf:wg:oauth:2.0:oob'),

    /*
    |--------------------------------------------------------------------------
    | API URL
    |--------------------------------------------------------------------------
    |
    | API URL for parasut.com.
    |
    | Default: "https://api.parasut.com"
    |
    */

    'api_url' => env('PARASUT_API_URL', 'https://api.parasut.com'),

    /*
    |--------------------------------------------------------------------------
    | API Version
    |--------------------------------------------------------------------------
    |
    | API Version for parasut.com.
    |
    | Default: "v4"
    |
    */

    'api_version' => env('PARASUT_API_VERSION', 'v4'),

    /*
    |--------------------------------------------------------------------------
    | Authorization URL
    |--------------------------------------------------------------------------
    |
    | Authorization URL for parasut.com.
    |
    | Default: "/oauth/authorize"
    |
    */

    'authorization_url' => env('PARASUT_AUTHORIZATION_URL', 'oauth/authorize'),

    /*
    |--------------------------------------------------------------------------
    | Token URL
    |--------------------------------------------------------------------------
    |
    | Token URL for parasut.com.
    |
    | Default: "/oauth/token"
    |
    */

    'token_url' => env('PARASUT_TOKEN_URL', 'oauth/token'),
];
