<?php

namespace App\Traits;

use App\Exceptions\Base\BaseException;
use App\Exceptions\Handler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait ApiResponder
{
    /*
    |--------------------------------------------------------------------------
    | Client error codes
    |--------------------------------------------------------------------------
    */
    private static string $ERROR_CODE_BAD_REQUEST = 'bad_request';
    private static string $ERROR_CODE_UNAUTHORIZED = 'unauthorized';
    private static string $ERROR_CODE_FORBIDDEN = 'forbidden';
    private static string $ERROR_CODE_NOT_FOUND = 'not_found';
    private static string $ERROR_CODE_METHOD_NOT_ALLOWED = 'method_not_allowed';
    private static string $ERROR_CODE_NOT_ACCEPTABLE = 'not_acceptable';
    private static string $ERROR_CODE_CONFLICT = 'conflict';
    private static string $ERROR_CODE_UNPROCESSABLE_ENTITY = 'unprocessable_entity';
    private static string $ERROR_CODE_TOO_MANY_REQUESTS = 'too_many_requests';

    /*
    |--------------------------------------------------------------------------
    | Server error codes
    |--------------------------------------------------------------------------
    */
    private static string $ERROR_CODE_INTERNAL_SERVER_ERROR = 'internal_server_error';
    private static string $ERROR_CODE_SERVICE_UNAVAILABLE = 'service_unavailable';

    /**
     * @var int
     */
    private int $statusCode = 200;

    /**
     * @var array
     */
    private array $data = [];

    /**
     * @var array
     */
    private array $errors = [];

    /**
     * @var string
     */
    private string $APIMessage = 'This is a default message, you should set your own message.';

    /**
     * @var array
     */
    private array $headers = ['Content-Type' => 'application/json',];

    /**
     * @var string
     */
    private string $errorCode = 'unhandled_error_code';

    /**
     * @var bool
     */
    private bool $paginated = false;

    /**
     * @return bool
     */
    public function isPaginated(): bool
    {
        return $this->paginated;
    }

    /**
     * @param  bool  $isPaginated
     *
     * @return Controller|BaseException|Handler|ApiResponder
     */
    public function setPaginated(bool $isPaginated): self
    {
        $this->paginated = $isPaginated;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param  int  $statusCode
     *
     * @return Controller|BaseException|Handler|ApiResponder
     */
    public function setStatusCode(int $statusCode): self
    {
        if (preg_match('/^[1-5]\d\d?$|^$/', $statusCode)) {
            $this->statusCode = $statusCode;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param  array  $data
     *
     * @return Controller|BaseException|Handler|ApiResponder
     */
    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param  array  $errors
     *
     * @return Controller|BaseException|Handler|ApiResponder
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param  array  $headers
     *
     * @return Controller|BaseException|Handler|ApiResponder
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = array_unique(array_merge($this->getHeaders(), $headers), SORT_REGULAR);
        return $this;
    }

    /**
     * @return string
     */
    public function getAPIMessage(): string
    {
        return $this->APIMessage;
    }

    /**
     * @param  string  $APImessage
     *
     * @return Controller|BaseException|Handler|ApiResponder
     */
    public function setAPIMessage(string $APImessage): self
    {
        $this->APIMessage = $APImessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * @param  string  $errorCode
     *
     * @return Controller|BaseException|Handler|ApiResponder
     */
    public function setErrorCode(string $errorCode): self
    {
        $this->errorCode = $errorCode;
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Successful response functions
    |--------------------------------------------------------------------------
    */
    /**
     * @param  array  $data
     * @param  string  $APImessage
     * @param  bool  $isPaginated
     * @param  array  $headers
     *
     * @return JsonResponse
     */
    public function respondOK(
        array $data = [],
        string $APImessage = '',
        bool $isPaginated = false,
        array $headers = []
    ): JsonResponse {
        $APImessage = $APImessage ?: __('messages.http.success.ok');
        $headers = array_unique(array_merge($this->getHeaders(), $headers), SORT_REGULAR);
        return $this->respondWithSuccess(
            statusCode: ResponseAlias::HTTP_OK,
            APImessage: $APImessage,
            headers: $headers,
            data: $data,
            isPaginated: $isPaginated
        );
    }

    /**
     * @param  array  $data
     * @param  string  $APImessage
     * @param  bool  $isPaginated
     * @param  array  $headers
     *
     * @return JsonResponse
     */
    public function respondCreated(
        array $data = [],
        string $APImessage = '',
        bool $isPaginated = false,
        array $headers = []
    ): JsonResponse {
        $APImessage = $APImessage ?: __('messages.http.success.created');
        $headers = array_unique(array_merge($this->getHeaders(), $headers), SORT_REGULAR);
        return $this->respondWithSuccess(
            statusCode: ResponseAlias::HTTP_CREATED,
            APImessage: $APImessage,
            headers: $headers,
            data: $data,
            isPaginated: $isPaginated
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Server error response functions
    |--------------------------------------------------------------------------
    */

    /**
     * @param  int  $statusCode
     * @param  string  $APImessage
     * @param  string  $errorCode
     * @param  array  $headers
     * @param  array  $errors
     *
     * @return JsonResponse
     */
    public function respondWithError(
        int $statusCode,
        string $errorCode,
        string $APImessage = '',
        array $headers = [],
        array $errors = []
    ): JsonResponse {
        if (!preg_match('/^[4-5]\d\d?$|^$/', $statusCode)) {
            $statusCode = ResponseAlias::HTTP_BAD_REQUEST;
        }
        $APImessage = $APImessage ?: __('messages.http.error.bad_request');

        $this->setStatusCode($statusCode)
            ->setAPIMessage($APImessage)
            ->setErrorCode($errorCode)
            ->setHeaders($headers)
            ->setErrors($errors);

        return $this->respond(false);
    }

    public function respondWithSuccess(
        int $statusCode,
        string $APImessage = '',
        array $headers = [],
        array $data = [],
        bool $isPaginated = false
    ): JsonResponse {
        if (!preg_match('/^[1-3]\d\d?$|^$/', $statusCode)) {
            $statusCode = ResponseAlias::HTTP_OK;
        }
        $APImessage = $APImessage ?? __('messages.http.success.ok');
        $this->setStatusCode($statusCode)
            ->setAPIMessage($APImessage)
            ->setHeaders($headers)
            ->setData($data)
            ->setPaginated($isPaginated);

        return $this->respond();
    }

    /**
     * @param  bool  $isSuccess
     *
     * @return JsonResponse
     */
    private function respond(bool $isSuccess = true): JsonResponse
    {
        $type = $isSuccess ? 'success' : 'error';
        $lookup = [
            'success' => [
                'message' => $this->getAPIMessage(),
                'data' => $this->extractData($this->getData()) ?? [],
                'pagination' => $this->extractPagination($this->getData()) ?? [],
            ],
            'error' => [
                'error_code' => $this->getErrorCode(),
                'message' => $this->getAPIMessage(),
                'errors' => $this->getErrors(),
            ],
        ];
        return response()->json($lookup[$type], $this->getStatusCode(), $this->getHeaders());
    }

    /**
     * @param  array  $data
     *
     * @return array|null
     */
    private function extractPagination(array $data): ?array
    {
        if (array_key_exists('pagination', $data)) {
            return $data['pagination'];
        }
        return [];
    }

    /**
     * @param  array  $data
     *
     * @return array|null
     */
    private function extractData(array $data): ?array
    {
        if (array_key_exists('data', $data)) {
            return $data['data'];
        }
        return $data;
    }
}
