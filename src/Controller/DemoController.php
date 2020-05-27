<?php

class DemoController
{
    public function indexAction()
    {
        $repository = new ImageSizeRepository();
        $imageSizeList = $repository->getImageSizeList();

        $view = new View();

        $view->data['images'] = json_encode([1,2,3,4,5,6,7,8,9,10]);
        $view->data['sizes'] = json_encode(array_map(
            fn(ImageSize $imageSize) => $imageSize->toArray(),
            $imageSizeList
        ));

        http_response_code(200);
        header('Content-Type:text/html');

        echo $view->render('../templates/demo.php');
    }
}
