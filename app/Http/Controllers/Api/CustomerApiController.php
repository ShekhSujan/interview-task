<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Exception;
use App\Http\Requests\CustomerCreateRequest;
use App\Repositories\CustomerRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerApiController extends Controller
{
    use ResponseTrait;

    public $customertRepository;

    public function __construct(CustomerRepository $customertRepository)
    {
        $this->customertRepository = $customertRepository;
    }


    public function index(): JsonResponse
    {
        try {
            return $this->responseSuccess($this->customertRepository->getAll(request()->all()), 'Customer fetched successfully.');
        } catch (Exception $exception) {
            return $this->responseError([], $exception->getMessage(), $exception->getCode());
        }
    }

    public function store(CustomerCreateRequest $request): JsonResponse
    {
        try {
            return $this->responseSuccess($this->customertRepository->create($request->all()), 'Customer created successfully.');
        } catch (Exception $exception) {
            return $this->responseError([], $exception->getMessage(), $exception->getCode());
        }
    }


}
