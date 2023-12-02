<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, Request $request) {
            if (app()->environment("production")) {
                $statusCode = 404;
                $title = "죄송합니다";
                $description = $e->getMessage() ?: "요청하신 페이지가 없습니다.";
                return response()->view("errors.notice", [
                    "title" => $title,
                    "description" => $description
                ], $statusCode);
            }
        });
    }
}
