<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\DTO\Market\MarketDTO;
use App\Exceptions\Base\BaseException;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\Market\MarketSaveRequest;
use App\Services\Market\Interfaces\IMarketService;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class MarketController extends Controller
{
    /**
     * @param IMarketService $marketService
     */
    public function __construct(private readonly IMarketService $marketService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function index(): JsonResponse
    {
        $marketDTO = $this->marketService->getAllWithPagination();
        return $this->respondOK($marketDTO->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MarketSaveRequest $request
     * @return JsonResponse
     * @throws UnknownProperties
     */
    public function store(MarketSaveRequest $request): JsonResponse
    {
        $marketDTO = new MarketDTO($request->validated());
        $marketDTO = $this->marketService->store($marketDTO);
        return $this->respondCreated($marketDTO->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     * @throws UnknownProperties|BaseException
     */
    public function show(int $id): JsonResponse
    {
        $marketDTO = $this->marketService->getById($id);
        return $this->respondOk($marketDTO->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MarketSaveRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws UnknownProperties|BaseException
     */
    public function update(MarketSaveRequest $request, int $id): JsonResponse
    {
        $marketDTO = new MarketDTO($request->validated());
        $marketDTO = $this->marketService->updateById($marketDTO, $id);
        return $this->respondOk($marketDTO->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws UnknownProperties|BaseException
     * @throws \Throwable
     */
    public function destroy(int $id): JsonResponse
    {
        $this->marketService->deleteById($id);
        return $this->respondOk();
    }
}
