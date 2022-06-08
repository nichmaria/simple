<?php

namespace Nimarya\Simple\Controllers;

class AuthorsController extends Controller
{
    protected function actionIndex(): void
    {
        echo 'authors index here';
    }

    protected function actionShow(): void
    {
        echo 'authors show here';
    }
}
