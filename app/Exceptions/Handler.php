<?php

namespace App\Exceptions;

use Auth;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // dd($request);
        // if ($exception->getMessage()=="Unauthenticated.") {
        //      return response()->view('auth.login');
        // }
        // if ($request->is('api/*') && $exception instanceof OAuthServerException || $exception instanceof AuthenticationException) {
        //     return response()->json(['status'=>'2','message' => 'Token is invalid.','data'=>array()], 200);
        //     # code...
        // }
        // return parent::render($request, $exception);

        if ($exception instanceof NotFoundHttpException) {
            if ($request->is('api/*')) {
                return response()->json(['message' => 'wrong url'], 404);
            }
            return response()->view('404', [], 404);
        }
        if ($exception->getMessage() == "Unauthenticated." && $request->is('api/*')) {
            $response['message'] = "You are not authorize.";
            return response()->json($response, 401);
        }

    //     if ($exception instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
    //         return redirect('/');
    //   }
        // if (!Auth::guard('api')->check()) {
        //     return response()->json(['message' => 'Your session is expired. Please Login again to continue.'], 401);
        //   }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            $json = [
                'status' => 401,
                'message' => $exception->getMessage(),
            ];
            return response()
                ->json($json, 401);
        }
        return redirect()->guest(route('login'));
    }
}
