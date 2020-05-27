<?php

class DemoController
{
    public function indexAction()
    {
        $repository = new ImageSizeRepository();
        $imageSizeList = $repository->getImageSizeList();

        $view = new View();


        $images = [];
        $cnt = 0;
        foreach (new DirectoryIterator('../gallery') as $fileInfo) {
            if($fileInfo->isDot()) continue;

            $images[] = str_ireplace(sprintf('.%s', $fileInfo->getExtension()),'', $fileInfo->getBasename()) ;

            $cnt++;

            if($cnt == 10) {
                break;
            }
        }

        $view->data['images'] = json_encode($images);
        $view->data['sizes'] = json_encode(array_map(
            fn(ImageSize $imageSize) => $imageSize->toArray(),
            $imageSizeList
        ));

        http_response_code(200);
        header('Content-Type:text/html');

        echo $view->render('../templates/demo.php');
    }
}
