<?php

namespace App\Models;

use Spot\EntityInterface as Entity;
use Spot\MapperInterface as Mapper;

class User extends \Spot\Entity
{
    protected static $table = 'users';

    public static function fields()
    {
        return [
            'id' => ['type' => 'integer', 'autoincrement' => true, 'primary' => true],

        ];
    }

    public static function relations(Mapper $mapper, Entity $entity)
    {
        return [

        ];
    }
}