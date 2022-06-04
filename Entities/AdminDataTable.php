<?php

namespace Entities;

class AdminDataTable
{
    private array $data;
    protected View $view;

    public function __construct(array $objects, array $functions)
    {
        $this->view = new View();
        $this->view->objects = $objects;
        $this->view->functions = $functions;
    }

    public function render()
    {
        $this->view->display(__DIR__ . '\..\templates\admindatatable.php');
    }
}
