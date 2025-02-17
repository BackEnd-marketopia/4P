<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([]);
        $middleware->alias([
            "lang"        => App\Http\Middleware\Lang::class,
            "checkAdmin"  => App\Http\Middleware\CheckAdmin::class,
            "WebLang"     => App\Http\Middleware\WebLang::class,
            "checkVendor" => App\Http\Middleware\CheckVendor::class,
            "checkProvider" => App\Http\Middleware\CheckProvider::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            // return Response::api(__('message.Not Found'), 404, false, 404);
        });
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            // return Response::api(__('message.unauthorized'), 401, false, 401);
        });
        $exceptions->render(function (Throwable $e, Request $request) {
            // return Response::api(__('message.Internal Server Error'), 500, false, 500);
        });
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage(),
                ], 401);
            }
        });
    })->create();
