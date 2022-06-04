<?php

namespace Controllers;

use Exceptions\MultiException;
use Entities\News;
use Exceptions\NotFoundException;
use Entities\AdminDataTable;


class ArticlesController extends Controller
{
    protected function actionDelete(): void
    {
        $id = key($_POST);
        if (gettype($id) == 'integer') {
            News::deleteById($id);
            header("Location: /articles");
        }
        if (gettype($id) != 'integer') {
            throw new \Exception('incorrect data for deleting');
        }
    }

    protected function actionAdmin(): void
    {
        $this->view->news = News::findAll();
        $excerp = function ($object) {
            $i = 70;
            $beggining = substr($object->getContent(), 0, $i);
            while (substr($beggining, -1) != ' ' && substr($beggining, -1) != '.') {
                $i++;
                $beggining = substr($object->getContent(), 0, $i);
            }
            return substr($beggining, 0, -1) . '...';
        };

        $funcTwo = function ($object) {
            $i = 70;
            $beggining = substr($object->getContent(), 0, $i);
            while (substr($beggining, -1) != ' ' && substr($beggining, -1) != '.') {
                $i++;
                $beggining = substr($object->getContent(), 0, $i);
            }
            return substr($beggining, 0, -1) . '...';
        };

        $functions = [$excerp, $funcTwo,];

        $table = new AdminDataTable($this->view->news, $functions);
        $table->render();
    }

    protected function actionIndex(): void
    {
        $this->view->generator = News::findEach();
        $this->view->display(__DIR__ . '\..\templates\index.php');
    }

    protected function actionShow(): void
    {
        try {
            $this->view->new = News::getById($this->id);
        } catch (NotFoundException $exeption) {
            throw new \Exception('page not found', 404);
        }

        $this->view->display(__DIR__ . '\..\templates\show.php');
    }

    protected function actionCreate(): void
    {
        $this->view->errors = [];
        if (!empty($_POST)) {
            $heading = $_POST['heading'];
            $content = $_POST['content'];

            $ex = new MultiException();

            if (gettype($heading) != 'string') {
                $ex[] =  new \Exception('incorrect type of heading!');
            }
            if (gettype($content) != 'string') {
                $ex[] = new \Exception('incorrect type of content!');
            }
            if ($heading == null) {
                $ex[] =  new \Exception('empty heading!');
            }
            if ($content == null) {
                $ex[] = new \Exception('empty content!');
            }

            try {
                if (!empty($ex->getData())) {
                    throw $ex;
                }

                News::createNew($heading, $content);
            } catch (MultiException $ex) {
                $this->view->errors = $ex;
            }
        }
        $this->view->display(__DIR__ . '\..\templates\create.php');
    }

    protected function actionEdit(): void
    {
        $this->view->new = News::getById($this->id);
        $this->view->errors = [];

        if (!empty($_POST)) {
            $heading = $_POST['heading'];
            $content = $_POST['content'];

            $info = ['heading' => $_POST['heading'], 'content' => $_POST['content'],];
            $ex = new MultiException();

            if (gettype($heading) != 'string') {
                $ex[] =  new \Exception('incorrect type of heading!');
            }
            if (gettype($content) != 'string') {
                $ex[] = new \Exception('incorrect type of content!');
            }
            if ($heading == null) {
                $ex[] =  new \Exception('empty heading!');
            }
            if ($content == null) {
                $ex[] = new \Exception('empty content!');
            }

            try {
                if (!empty($ex->getData())) {
                    throw $ex;
                }

                $this->view->new->edit($info);
            } catch (MultiException $ex) {
                $this->view->errors = $ex;
            }
        }
        $this->view->display(__DIR__ . '\..\templates\edit.php');
    }
}
