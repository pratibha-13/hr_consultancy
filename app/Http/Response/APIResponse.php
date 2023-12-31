<?php

/** @noinspection ALL */

namespace App\Http\Response;

use App\Helper\GlobalHelper;
use http\Exception\BadMethodCallException;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response as ResponseHTTP;

/**
 * Developed By : Kaushal Adhiya
 */

class APIResponse
{
    /**
     * Default is (200).
     *
     * @var int
     */
    protected $statusCode = ResponseHTTP::HTTP_OK;
    /*** @var array
     */
    protected $headers = [];
    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return mixed
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        // Static Status code
        // $this->statusCode = 200;
        return $this;
    }

    /**
     * Responds with JSON, status code and headers.
     *
     * @param array $data
     * @return JsonResponse
     */
    public function respond(array $data)
    {
        return new JsonResponse(
            $data,
            $this->getStatusCode(),
            $this->getHeaders()
        );
    }

    /**
     *  create API structure.
     *
     * @param type $success
     * @param type $payload
     * @param type $message
     * @param type $debug
     * @return type
     */

    public function getResponseStructure(
        $success = false,
        $payload = null,
        $message = "",
        $debug = null
    ) {
        if ($payload == null) {
            $payload = [];
        }

        if ($success = true) {
            if (isset($debug)) {
                $data = [
                    "message" => $message,

                    "data" => $payload,

                    "debug" => $debug,
                ];
            } else {
                $data = [
                    "message" => $message,

                    // 'data' => $payload
                ];
            }
        } else {
            $data = [
                "message" => $message,

                // 'data' => $payload
            ];
        }

        return $data;
    }

    /**
     *
     * @param array $data
     * @return JsonResponse
     */

    public function respondWithData(array $data)
    {
        $responseData = $this->getResponseStructure(true, $data, "");

        return new JsonResponse(
            $responseData,
            $this->getStatusCode(),
            $this->getHeaders()
        );
    }

    /**
     * Use this for responding with messages.
     *
     * @param $message
     * @return JsonResponse
     */
    public function respondWithMessage($message = "Ok")
    {
        $data = $this->getResponseStructure(true, null, $message);

        return $this->respond($data);
    }

    /**
     * @param null $payload
     * @param string $message
     * @return JsonResponse
     */

    public function respondWithMessageAndPayload(
        $payload = null,
        $message = "Ok"
    ) {
        $data = $this->getResponseStructure(true, $payload, $message, true);

        return $this->respond($data);
    }

    /**
     * @param string $message
     * @param null $e
     * @param null $data
     * @return JsonResponse|null
     */

    public function respondWithError(
        $message = "Error",
        $e = null,
        $data = null
    ) {
        $response = null;

        if (\App::environment("local", "staging") && isset($e)) {
            $debug_message = $e;

            $data = $this->getResponseStructure(
                false,
                $data,
                $message,
                $debug_message
            );
        } else {
            $data = $this->getResponseStructure(false, $data, $message);
        }

        $response = $this->respond($data);

        return $response;
    }

    /**
     * Use this to respond with a message (200).
     *
     * @param $message
     * @return JsonResponse
     */

    public function respondOk($message = "Ok")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_OK)
            ->respondWithMessage($message);
    }

    /**
     * Use this when a resource has been created (201).
     *
     * @param $message
     * @return mixed
     */

    public function respondCreated($message = "Created")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_CREATED)
            ->respondWithMessage($message);
    }

    /**
     * @param null $payload
     * @param string $message
     * @return mixed
     */

    public function respondCreatedWithPayload(
        $payload = null,
        $message = "Created"
    ) {
        return $this->setStatusCode(ResponseHTTP::HTTP_CREATED)
            ->respondWithMessageAndPayload($payload, $message);
    }

    /**
     * Use this when a resource has been updated (202).
     *
     * @param $message
     * @return mixed
     */

    public function respondUpdated($message = "Updated")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_ACCEPTED)
            ->respondWithMessage($message);
    }

    /**
     * @param null $payload
     * @param string $message
     * @return mixed
     */

    public function respondUpdatedWithPayload(
        $payload = null,
        $message = "Updated"
    ) {
        return $this->setStatusCode(ResponseHTTP::HTTP_ACCEPTED)
            ->respondWithMessageAndPayload($payload, $message);
    }

    /**
     * Use this when a resource has been deleted (202).
     *
     * @param $messageKey
     * @return mixed
     */

    public function respondDeleted($message = "Deleted")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_ACCEPTED)
            ->respondWithMessage($message);
    }

    /**
     * Use this when a resource has been deleted (202).
     *
     * @param $messageKey
     * @return mixed
     */

    public function respondDeletedWithPayload(
        $payload = null,
        $message = "Deleted"
    ) {
        return $this->setStatusCode(ResponseHTTP::HTTP_ACCEPTED)
            ->respondWithMessageAndPayload($payload, $message);
    }

    /**
     * Use this when the user needs to be authorized to do something (401).
     *
     * @param $message
     * @return mixed
     */

    public function respondUnauthorized($message = "Unauthorized")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_UNAUTHORIZED)
            ->respondWithError($message);
    }

    /**
     * Use this when the user does not have permission to do something (403).
     *
     * @param string $message
     * @return mixed
     */

    public function respondForbidden($message = "Forbidden")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_FORBIDDEN)
            ->respondWithError($message);
    }

    /**
     * Use this when a resource is not found (404).
     *
     * @param string $message
     * @return mixed
     */

    public function respondNotFound($message = "Not Found")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_NOT_FOUND)
            ->respondWithError($message);
    }

    /**
     * @param string $message
     * @param null $data
     * @return mixed
     */

    public function respondValidationError(
        $message = "Validation Error",
        $data = null
    ) {
        return $this->setStatusCode(ResponseHTTP::HTTP_BAD_REQUEST)
            ->respondWithError($message, null, $data);
    }

    /**
     * Use this for general server errors (500).
     *
     * @param string $message
     * @return mixed
     */

    public function respondInternalError($message, $e)
    {
        $message = $message ?: "Internal Error";

        return $this->setStatusCode(ResponseHTTP::HTTP_INTERNAL_SERVER_ERROR)
            ->respondWithError($message, $e);
    }

    /**
     * Use this for general server errors (500).
     *
     * @param string $message
     * @return mixed
     */

    public function respondCustomError($message, $status_code, $e)
    {
        $message = $message ?: "Internal Error";

        return $this->setStatusCode($status_code)->respondWithError(
            $message,
            $e
        );
    }

    /**
     * Use this for HTTP not implemented errors (501).
     *
     * @param string $message
     * @return mixed
     */

    public function respondNotImplemented($message = "Internal Error")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_NOT_IMPLEMENTED)
            ->respondWithError($message);
    }

    /**
     * Use this for conflict of resource which already exists with unique key.
     *
     * @param string $message
     * @return mixed
     */

    public function respondResourceConflict(
        $message = "Resource Already Exists"
    ) {
        return $this->setStatusCode(ResponseHTTP::HTTP_CONFLICT)
            ->respondWithError($message);
    }

    public function respondResourceConflictWithData(
        $payload = null,
        $message = "Resource Already Exists",
        $responseCode = ResponseHTTP::HTTP_CONFLICT
    ) {
        return $this->setStatusCode(
            $responseCode
        )->respondWithMessageAndPayload($payload, $message);
    }

    /**
     * @param \Illuminate\Contracts\Filesystem\Filesystem $file
     * @param $mime
     * @return mixed
     */

    public function respondWithFile($file, $mime)
    {
        return (new \Illuminate\Http\Response(
            $file,
            ResponseHTTP::HTTP_OK
        ))->header("Content-Type", $mime);
    }

    public function respondNoContent($message)
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_NO_CONTENT)
            ->respondWithMessage($message);
    }

    /**
     * Use this for conflict of resource which already exists with unique key.
     *
     * @param string $message
     * @return mixed
     */

    public function respondBadRequest($message = "Bad Request")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_BAD_REQUEST)
            ->respondWithError($message);
    }

    /**
     * Use this for conflict of resource which already exists with unique key.
     *
     * @param string $message
     * @return mixed
     */

    public function respondHTTPNotAcceptable($message = "HTTP Not Acceptable")
    {
        return $this->setStatusCode(ResponseHTTP::HTTP_NOT_ACCEPTABLE)
            ->respondWithError($message);
    }

    public function handleAndResponseException(\Exception $ex)
    {
        $response = "";

        switch (true) {
            case $ex instanceof
                \Illuminate\Database\Eloquent\ModelNotFoundException:
                $response = $this->respondNotFound("Record not found");

                break;

            case $ex instanceof
                \Symfony\Component\HttpKernel\Exception\NotFoundHttpException:
                $response = $this->respondNotFound("Not found");

                break;

            case $ex instanceof
                \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException:
                $response = $this->respondForbidden("Access denied");

                break;

            case $ex instanceof
                \Symfony\Component\HttpKernel\Exception\BadRequestHttpException:
                $response = $this->respondBadRequest("Bad request");

                break;

            case $ex instanceof BadMethodCallException:
                $response = $this->respondBadRequest("Bad method Call");

                break;

            case $ex instanceof
                \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException:
                $response = $this->respondForbidden("Method not found");

                break;

            case $ex instanceof \Illuminate\Database\QueryException:
                $response = $this->respondValidationError(
                    "Something went wrong with your query",
                    [$ex->getMessage()]
                );

                break;

            case $ex instanceof
                \Illuminate\Http\Exceptions\HttpResponseException:
                $response = $this->respondInternalError(
                    "Something went wrong with our system",
                    [$ex->getMessage()]
                );

                break;

            case $ex instanceof \Illuminate\Auth\AuthenticationException:
                $response = $this->respondUnauthorized("Unauthorized request");

                break;

            case $ex instanceof \Illuminate\Validation\ValidationException:
                $response = $this->respondValidationError("In valid request", [
                    $ex->getMessage(),
                ]);

                break;

            case $ex instanceof \Tymon\JWTAuth\Exceptions\JWTException:
                $response = $this->respondUnauthorized("Unauthorized request");

                break;

            case $ex instanceof
                \Tymon\JWTAuth\Exceptions\TokenBlacklistedException:
                $response = $this->respondUnauthorized("Unauthorized request");

                break;

            case $ex instanceof \Exception:
                $response = $this->respondInternalError(
                    "Something went wrong with our system",
                    [$ex->getMessage()]
                );

                break;
        }

        return $response;
    }

    /**
     * Prepare success response
     *
     * @param string $apiStatus
     * @param string $apiMessage
     * @param Illuminate\Pagination\LengthAwarePaginator $apiData
     * @return Illuminate\Http\JsonResponse
     */
    public function successWithPagination(
        // int $apiStatus,
        string $apiMessage = "",
        LengthAwarePaginator $apiData = null,
        $apiOtherData = null
    ): JsonResponse {
        // $response['status'] = $apiStatus;
        // dd($apiData->count());
        // Check response data have pagination or not? Pagination response parameter sets
        if ($apiData->count()) {
            $apiData->appends(["perPage" => $apiData->perPage()]);

            if ($apiData->currentPage() !== $apiData->lastPage()) {
                $nextPage = $apiData->currentPage() + 1;
            } else {
                $nextPage = "";
            }

            $response["data"] = GlobalHelper::removeNull(
                $this->objectToArray($apiData->toArray()["data"])
            );
            $response["total"] = $apiData->total();
            $response["limit"] = (int) $apiData->perPage();
            $response["page"] = $apiData->currentPage();
            $response["pages"] = $apiData->lastPage();
            if($apiOtherData) {
                $response["other_data"] = $apiOtherData;
            }
        } else {
            $response["data"] = [];

            $response["total"] = $apiData->total();

            $response["limit"] = (int) $apiData->count();

            $response["page"] = $apiData->currentPage();

            $response["pages"] = $apiData->lastPage();
            if($apiOtherData) {
                $response["other_data"] = $apiOtherData;
            }
        }

        if ($apiMessage) {
            $response["message"] = $apiMessage;
        }

        return response()->json($response);
    }

    public function objectToArray(&$object)
    {
        return json_decode(json_encode($object), true);
    }
}
