<?php

namespace App\Exceptions;
use Validator;
use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\QueryException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Traits\ApiResponser;
class Handler extends ExceptionHandler
{

    use ApiResponser;
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof ValidationException){
          return $this->convertValidationExceptionToResponse($exception,$request);
        }

        if($exception instanceof ModelNotFoundException){
          $modelName = strtolower(class_basename($exception->getModel()));
          return $this->errorResponse("Does not exists the {$modelName} for this ID",404);
        }

        if($exception instanceof AuthenticationException){
          return $this->unauthenticated($request,$exception);
        }

        if($exception instanceof AuthenticationException){
          return $this->unauthenticated($request,$exception);
        }

        if($exception instanceof AuthorizationException){
          return $this->errorResponse($exception->getMessages(),403);
        }

        if($exception instanceof MethodNotAllowedHttpException){
          return $this->errorResponse('The method is not correct',405);
        }


        if($exception instanceof NotFoundHttpException){
          return $this->errorResponse("The URL Not Found Or Maybe changed",403);
        }

        if($exception instanceof HttpException){
          return $this->errorResponse($exception->getMessages(),$exception->getStatusCode());
        }

        if($exception instanceof QueryException){

          $errorcode = $exception->errorInfo['1'];
          if($errorcode == 1451){
            return $this->errorResponse("You can not remove This resource because it relats any othe resource in DB",409);
          }
        }

        //return $this->errorResponse("Unexcepted Exception Try Again",500);
        //if any of exception above Not Work I t will run this command

        if(config('app.debug')){
          return parent::render($request, $exception);
        }


    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse('unauthenticated',422);
    }


    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {

      $errors = $e->validator->errors()->getMessages();
      return $this->errorResponse($errors,422);

    }
}
