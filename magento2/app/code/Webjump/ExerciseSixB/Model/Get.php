<?php

namespace Webjump\ExerciseSixB\Model;

use Webjump\ExerciseSixB\Api\GetInterface;

class Get implements GetInterface
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
