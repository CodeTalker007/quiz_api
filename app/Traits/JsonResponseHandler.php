<?php

namespace App\Traits;

use App\Constants\ResponseConstant;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponseHandler
{
    private int $statusCode = Response::HTTP_OK;

    private bool $successStatus = ResponseConstant::SUCCESS_TRUE;

    private $errors = [];

    private $responseData = [];

    /**
     * Return JSON response
     */
    public function returnJsonResponse(): JsonResponse
    {
        return response()->json([
            'success' => $this->successStatus,
            'errors' => $this->errors,
            'data' => $this->responseData,
        ], $this->statusCode);
    }

    /**
     * Handel exception and set error
     */
    public function handelException(\Exception $exception): void
    {
        // Set success false
        $this->setSuccessStatus(ResponseConstant::SUCCESS_FALSE);

        // Set Status Code
        $this->setStatusCode(
            ($exception->getCode() == Response::HTTP_BAD_REQUEST)
                ? Response::HTTP_BAD_REQUEST
                : Response::HTTP_INTERNAL_SERVER_ERROR
        );

        // Set Error message
        $this->setErrors(
            [
                'message' => ($exception->getCode() == Response::HTTP_BAD_REQUEST)
                    ? $exception->getMessage()
                    : ResponseConstant::SERVER_ERROR,
                'exception' => $exception->getMessage()
            ]
        );
    }

    /**
     * Set Status Code for response
     */
    public function setStatusCode(int $statusCode = Response::HTTP_OK): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Set Success Status for response
     */
    public function setSuccessStatus(bool $status = ResponseConstant::SUCCESS_TRUE): void
    {
        $this->successStatus = $status;
    }

    /**
     * Set data for response
     */
    public function setData($responseData = null): void
    {
        $this->responseData = $responseData;
    }

    /**
     * Set errors for responses
     */
    public function setErrors($errors = null): void
    {
        $this->errors = $errors;
    }
}
