<?php

namespace App\Interfaces;

interface PerkInterface extends BaseInterface
{
    public function getAllWithPagination();
    public function reactiveById(int $id);
}