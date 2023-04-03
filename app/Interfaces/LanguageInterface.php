<?php

namespace App\Interfaces;

interface LanguageInterface extends BaseInterface
{
    public function getAllWithPagination();
    public function reactiveById(int $id);
}