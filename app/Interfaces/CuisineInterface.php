<?php

namespace App\Interfaces;

interface CuisineInterface extends BaseInterface
{
    public function getAllWithPagination();
    public function reactiveById(int $id);
}