<?php

namespace Controllers;

use Core\Prototype\Request;

class IndexController
{
    #[Route(name: 'index', path: '/', methods: ['GET'])]
    public function index(Request $request)
    {
        return file_get_contents(PROJECT_DIR.'/templates/index.html');
        // return [
        //     'body' => '</br>ResponseBody</br>'
        // ];
    }
}