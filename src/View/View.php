<?php

class View
{
    public $data = [];

    public function render(string $template)
    {
        if (!is_file($template)) {
            throw new RuntimeException('Template not found: ' . $template);
        }

        $result = function($file, array $data = array()) {
            ob_start();
            extract($data, EXTR_SKIP);
            try {
                include $file;
            } catch (\Exception $e) {
                ob_end_clean();
                throw $e;
            }
            return ob_get_clean();
        };

        echo $result($template, $this->data);
    }
}