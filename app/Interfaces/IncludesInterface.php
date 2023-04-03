<?php

namespace App\Interfaces;

interface IncludesInterface extends BaseInterface
{
    public function getAllWithPagination();
    public function reactiveById(int $id);
}