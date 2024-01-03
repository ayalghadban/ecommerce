<?php

namespace App\Exceptions;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    public function render($request, Throwable $exception)
    {
    //         if($exception){
    //             return (new Controller)->sendError(__('messages.server_error'), 500);
    //         }
        return parent::render($request, $exception);
    }
    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        try {
            $this->renderable(function (AccessDeniedHttpException $e, $request) {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.unauthorized'),
                ], 403);
            });

            $this->renderable(function (PostTooLargeException $e, $request) {
                return response()->json([
                    'success' => false,
                    'message' => __('auth.max_size_image'),
                ], 403);
            });
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => __('messages.get_data_error'),
            ], 403);
        }
    }

    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     return redirect()->route('unauthorized');
    // }
}
