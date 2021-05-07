<?php

namespace Webjump\ExerciseSixB\Api;

interface PostInterface {
    /**
     * @param string $param
     * @return array
     */
	public function getParam(string $param): array;
}
