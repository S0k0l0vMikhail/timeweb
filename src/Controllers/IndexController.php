<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\IndexRepository;

/**
 * Контроллер главное страницы
 */
class IndexController extends Controller
{
    private $indexRepository;

    public function __construct()
    {
        $this->indexRepository = new IndexRepository();
    }

    public function indexAction()
    {
        $template = 'main.twig';
        $data = [
            'title'=>'Главная',
        ];

        echo $this->renderPage( $template, $data );
    }

}
