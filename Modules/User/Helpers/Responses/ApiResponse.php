<?php

namespace Modules\User\Helpers\Responses;

use Modules\User\Enum\Response\ResponseCode;
use Throwable;
use Illuminate\Http\JsonResponse;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Container\BindingResolutionException;

final class ApiResponse
{
    /**
     * @var ResponseCode
     */
    private ResponseCode $code = ResponseCode::SUCCESS;
    /**
     * @var array<string, mixed>
     */
    private array $meta = [];
    /**
     * @var mixed|null
     */
    private mixed $data = null;
    /**
     * @var bool
     */
    private bool $forceLogout = false;

    private int $httpStatusCode = Response::HTTP_OK;

    private ?string $message = null;


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function data(mixed $data): ApiResponse
    {
        $this->data = $data;

        if ($data instanceof LengthAwarePaginator) {
            $this->pagination($data);
        } elseif ($data instanceof Throwable) {
            $this->exception($data);
        }

        return $this;
    }

    public function code(ResponseCode $responseCode): ApiResponse
    {
        $this->code = $responseCode;

        return $this;
    }

    public function message(string $message): ApiResponse
    {
        $this->message = $message;

        return $this;
    }

    public function meta(string $responseKey, mixed $data): ApiResponse
    {
        $this->meta[$responseKey] = $data;

        return $this;
    }

    public function pagination(LengthAwarePaginator $paginator): ApiResponse
    {
        $arrPagination = [
            'total'        => $paginator->total(),
            'count'        => $paginator->count(),
            'per_page'     => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'last_page'    => $paginator->lastPage(),
            'from'         => $paginator->firstItem(),
            'to'           => $paginator->lastItem()
        ];

        return $this->meta("pagination", $arrPagination);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function exception(mixed $exception): ApiResponse
    {
        if ($exception instanceof Throwable) {
            $this->data = $exception->getMessage();

            if (config("app.debug") === true) {
                $this->meta("line", $exception->getLine());
                $this->meta("file", $exception->getFile());
                $this->meta("trace", $exception->getTrace());
            }
        }

        return $this;
    }

    public function logout(): ApiResponse
    {
        $this->forceLogout = true;

        return $this;
    }

    public function status(int $code): ApiResponse
    {
        $this->httpStatusCode = $code;

        return $this;
    }

    /**
     * @param mixed|null $data
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function success(mixed $data = null): JsonResponse
    {
        if (!is_null($data)) {
            $this->data($data);
        }

        $arrResponse = [
            "status"      => $this->code->value,
            "message"     => $this->message ?? $this->code->message(),
            "forceLogout" => $this->forceLogout,
            "data"        => $this->data,
            "meta"        => $this->meta
        ];

        return response()->json($arrResponse, $this->httpStatusCode);
    }

    /**
     * @param mixed|null $data
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function error(mixed $data = null): JsonResponse
    {
        if (!is_null($data)) {
            $this->exception($data);
        }

        $arrResponse = [
            "status"      => $this->code->value,
            "message"     => $this->message ?? $this->code->message(),
            "forceLogout" => $this->forceLogout,
            "error"       => $this->data,
            "exception"   => $this->meta
        ];

        $intStatusCode = $this->httpStatusCode >= Response::HTTP_BAD_REQUEST ? $this->httpStatusCode :
            Response::HTTP_INTERNAL_SERVER_ERROR;

        return response()->json($arrResponse, $intStatusCode);
    }
}
