<?php

namespace App\Interfaces;

interface RequestInterface
{
    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments);

    /**
     * @return mixed
     */
    public function validate();
}
