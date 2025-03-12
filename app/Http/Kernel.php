protected $middlewareAliases = [
    'auth' => \App\Http\Middleware\AuthMiddleware::class,
    'cors' => \Illuminate\Http\Middleware\HandleCors::class, // Add this line
];
