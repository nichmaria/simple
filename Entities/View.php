<?php

namespace Entities;

use Traits\DinamicPropertiesTrait;

class View
{
    use DinamicPropertiesTrait;

    public function render(string $template): string
    {
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display(string $template): void
    {
        echo $this->render($template);
    }
}
