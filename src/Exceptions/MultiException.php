<?php

namespace Nimarya\Simple\Exceptions;

use Nimarya\Simple\Traits\ArrayTrait;

class MultiException extends \Exception implements \ArrayAccess, \Iterator
{
    use ArrayTrait;
    public function getData(): array
    {
        return $this->data;
    }
}
