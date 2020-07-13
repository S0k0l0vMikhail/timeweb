<?php

namespace App\Core;

/**
 * Базовый класс для контроллеров
 */
class Controller
{
    public function renderPage( $template, $data = [] )
    {
        extract($data);
        ob_start();
        include_once __DIR__ . '/../Views/' . $template;
        $page = ob_get_contents();
        ob_end_clean();

        return $page;
    }

    public function json( $data = [] )
    {

        return json_encode($data);
    }

    public function request()
    {
        $post = file_get_contents('php://input');

        return json_decode($post, true);
    }
}
