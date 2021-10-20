<?php

namespace App\Exceptions;

use App\Traits\TResponder;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use TResponder;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        ApplicationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ApplicationException) {
            $code = $e->getCode();
            $message = $e->getMessage();
            return $this->error(null, $message, $code);
        }

        if (env('APP_DEBUG', false)) {
            return parent::render($request, $e);
        }

        // @phpstan-ignore-next-line
        return $this->fatalError($e);
    }
}
