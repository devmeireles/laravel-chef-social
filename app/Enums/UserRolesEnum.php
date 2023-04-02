<?php

namespace App\Enums;

enum UserRolesEnum: int
{
    case CLIENT = 1;
    case CHEF = 2;
    case ADMIN = 3;
}