<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\IndexRepository;

/**
 * Контроллер страницы вывода результата
 */
class ResultsController extends Controller
{
    private $indexRepository;

    public function __construct()
    {
        $this->indexRepository = new IndexRepository();
    }

    public function indexAction()
    {
        $template = 'results.twig';

        $data = [
            'title' => 'Результаты',
        ];

        echo $this->renderPage( $template, $data );
    }

    /**
     * Метод получения списка результатов требуемого типа
     */
    public function getListsAction()
    {
        $request = $this->request();

        try {
            if (!isset($request['selected'])) {
                throw new \Exception('Не выбран требуемый тип результатов');
            }

            $data = $this->indexRepository->getAllByTable($request['selected']);

            if (!$data) {
                throw new \Exception('Что то пошло не так');
            }

            foreach ($data as &$row) {
                $row['elements'] = json_decode($row['elements'], true);
                $row['elementsCount'] = count($row['elements'], true);
            }

            echo $this->json($data);
        } catch (\Exception $e) {
            echo $this->json(['error' => 'Ошибка: ' . $e->getMessage()]);
        }
    }
}
