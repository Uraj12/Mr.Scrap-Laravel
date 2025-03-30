protected $middlewareAliases = [
    'auth' => \App\Http\Middleware\AuthMiddleware::class,
    'cors' => \Illuminate\Http\Middleware\HandleCors::class, // Add this line
];

protected $middlewareGroups = [
    'web' => [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,  // ✅ Email verification middleware
    ],
];
