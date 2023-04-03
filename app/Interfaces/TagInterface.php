<?php

namespace App\Interfaces;

interface TagInterface extends BaseInterface
{
    public function getAllWithPagination();
    public function reactiveById(int $id);
}