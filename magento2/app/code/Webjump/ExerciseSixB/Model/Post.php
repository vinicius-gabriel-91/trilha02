<?php

namespace Webjump\ExerciseSixB\Model;

use Webjump\ExerciseSixB\Api\PostInterface;

class Post implements PostInterface
{
    /**
     * @param string $param
     * @return array
     */
    public function getParam(string $param): array
    {
         return ["message" => "success webapi: {$param}"];
    }

}
