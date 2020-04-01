<?php

namespace App\Exceptions;

use App\Enums\CodeEnum;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ApiResponse;
use League\CommonMark\Inline\Element\Code;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    use ApiResponse;

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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        //parent::report($exception);
        $log = [
            "[Code:{$exception->getCode()}]",
            "{$exception->getMessage()}",
            "on line {$exception->getLine()}",
            "of file {$exception->getFile()}"
        ];
        Log::error(implode(' ',$log), array_slice($exception->getTrace(),0,2));
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof ApiException){
            $err = [$exception->getCode(),$exception->getMessage()];
            if(!$err[0]){
                $err = CodeEnum::ERROR_SERVER;
            }
            return $this->error(null,$err);
        }else{
            //return $this->error(null,CodeEnum::ERROR_SERVER);
        }

        return parent::render($request, $exception);
    }
}
