<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\Paginator;

interface CrudInterface
{
    public function getAll(array $filterData): Paginator;


    public function create(array $data): object|null;

}
