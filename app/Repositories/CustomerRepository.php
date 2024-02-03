<?php

namespace App\Repositories;

use Exception;
use App\Interfaces\CrudInterface;
use App\Interfaces\DBPreparableInterface;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CustomerRepository implements CrudInterface
{
    public function getAll(array $filterData): Paginator
    {
        $filter = $this->getFilterData($filterData);

        $query = Customer::orderBy($filter['orderBy'], $filter['order']);

        if (!empty($filter['search'])) {
            $query->where(function ($query) use ($filter) {
                $searched = '%' . $filter['search'] . '%';
                $query->where('first_name', 'like', $searched)
                    ->orWhere('last_name', 'like', $searched);
            });
        }

        return $query->paginate($filter['perPage']);
    }

    public function getFilterData(array $filterData): array
    {
        $defaultArgs = [
            'perPage' => 10,
            'search' => '',
            'orderBy' => 'id',
            'order' => 'desc'
        ];

        return array_merge($defaultArgs, $filterData);
    }



    public function create(array $data): ?Customer
    {
        return Customer::create($data);
    }



  }
