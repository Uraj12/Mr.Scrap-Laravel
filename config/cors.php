<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration file allows you to manage Cross-Origin Resource Sharing
    | (CORS) settings for your Laravel application. It helps control how your
    | API interacts with external domains, ensuring security and accessibility.
    |
    */

    'paths' => ['api/*'], // Apply CORS to API routes

    'allowed_methods' => ['*'], // Allow all HTTP methods (GET, POST, PUT, DELETE, etc.)

    'allowed_origins' => ['*'], // Allow requests from all origins

    'allowed_headers' => ['*'], // Allow all headers

    'exposed_headers' => [], // Headers that are exposed to the client

    'max_age' => 0, // Max age for preflight requests (0 means disabled)

    'supports_credentials' => false, // Set to true if authentication cookies should be sent with cross-origin requests

];
