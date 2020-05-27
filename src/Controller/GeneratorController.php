<?php

class GeneratorController
{
    public function indexAction()
    {
        try {
            if (!array_key_exists('name', $_GET) || !array_key_exists('size', $_GET)) {
                throw new RuntimeException('Отсутствуют необходимые параметры запроса.');
            }

            $name = str_replace(['..', '/', '\\'], '', $_GET['name']);
            $type = $_GET['size'];

            $repository = new ImageSizeRepository();
            $imageSize = $repository->getImageSizeByType($type);

            if (!$imageSize) {
                throw new RuntimeException('Некорректный размер изображения.');
            }

            if(!file_exists('../cache/')) {
                mkdir('../cache/');
            }

            $file = sprintf('../gallery/%s.jpg', $name);
            $resizedFile = sprintf('../cache/\%s-%s.jpg', $imageSize->getType(), $name);

            if (!file_exists($file)) {
                throw new RuntimeException('Требуемый файл не существует.');
            }

            if (!file_exists($resizedFile)) {
                $imageService = new ImageService();
                $imageService->resize($file, $resizedFile, $imageSize->getWidth(), $imageSize->getHeight());
            }

            http_response_code(200);
            header('Content-Type:image/jpeg');
            header(sprintf('Content-Length:%s', filesize($resizedFile)));
            readfile($resizedFile);
        } catch (RuntimeException | ImageException $e) {
            http_response_code(400);
        }
    }
}
