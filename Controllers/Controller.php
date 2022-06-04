<?php

namespace Controllers;

use Entities\View;

class Controller
{
    protected View $view;
    protected int $id;

    public function __construct(int $id)
    {
        $this->view = new View();
        $this->id = $id;
    }

    public function action(string $name)
    {
        $methodName = 'action' . $name;
        return $this->$methodName();
    }
}
