<?php

namespace App\Exceptions;

use Error;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }
  /*public function render($request , Throwable $exception)
    {

        if($exception instanceof GeneralException){
            return response()->json([
                'success' =>false,
                'status' => 500 ,
                'message' =>$exception->getMessage()
            ]);
        }
        if($exception){
            return response()->json([
                'success' =>false,
                'status' => 500 ,
                'message' =>'Error In Server Please Try Again Later '
            ]);
        }

        //  throw new Error('catch error');
    }*/
}
