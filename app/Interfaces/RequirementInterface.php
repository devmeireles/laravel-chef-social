<?php

namespace App\Interfaces;

interface RequirementInterface extends BaseInterface
{
    public function getAllWithPagination();
    public function reactiveById(int $id);
}