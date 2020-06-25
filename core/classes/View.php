<?php

namespace Core;

use Exception;

class View
{
    protected $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function render($template_path)
    {
        // check if the template exists
        if (!file_exists($template_path)) {
            throw new Exception("Template with filename: $template_path does not exist");
        }

        $data = $this->data;

        ob_start();

        require_once $template_path;

        return ob_get_clean();

    }

    public function &getData()
    {
        return $this->data;
    }
}
