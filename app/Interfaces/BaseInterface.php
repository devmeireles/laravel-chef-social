<?php

namespace App\Interfaces;

interface BaseInterface
{
    public function getById(int $id);
    public function createItem(array $item);
    public function updateItem(array $item, int $id);
    public function destroyById(int $id);
}