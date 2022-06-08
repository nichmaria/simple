<?php

namespace Nimarya\Simple\Exceptions;

class NotFoundException extends \Exception
{
    public function __construct()
    {
        $this->message = 'model with this id does not exist';
    }
}
