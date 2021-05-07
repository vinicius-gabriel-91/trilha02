<?php

namespace Webjump\ExerciseSixB\Api;

interface GetInterface {
    /**
     * @param string $param
     * @return array
     */
	public function getParam(string $param): array;
}
