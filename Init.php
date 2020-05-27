<?php

class Init
{
    private static ?Init $init = null;

    public static function boot(string $src)
    {
        if (!self::$init) {
            $init = new static();
            $init->loadPhpFiles($src);
        }
    }

    private function loadPhpFiles(string $dir)
    {
        $item = glob($dir);

        foreach ($item as $filename) {
            if (is_dir($filename)) {
                $this->loadPhpFiles($filename . '/' . "*");
            } elseif (is_file($filename)) {
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                if ($extension == 'php') {
                    require_once($filename);
                }
            }
        }
    }
}
