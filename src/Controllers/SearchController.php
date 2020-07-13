<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\IndexRepository;

/**
 * Контроллер поиска
 */
class SearchController extends Controller
{
    private $indexRepository;

    public function __construct()
    {
        $this->indexRepository = new IndexRepository();
    }

    /**
     * Метод поиска и сохранения
     */
    public function indexAction()
    {
        $request = $this->request();

        try {
            if ($request['url'] === '' && $request['selected'] === '' && $request['text'] === '') {
                throw new \Exception('Не переданы обязательные поля');
            }

            if ( strlen($request['url']) > 50 ) {
                throw new \Exception('Адрес сайта слишком длинный');
            }

            if ( strlen($request['text']) > 50 ) {
                throw new \Exception('Текст для поиска слишком длинный');
            }

            $findElem = $request['selected'] == 'links'
                ? '/<[Aa][\s]{1}[^>]*[Hh][Rr][Ee][Ff][^=]*=[ \'\"\s]*([^ \"\'>\s#]+)[^>]*>/'
                : ($request['selected'] == 'pictures' ? "/([a-z\-_0-9\/\:\.]*\.(jpg|jpeg|png))/i" : '/' . $request['text'] . '/ui');

            if ((boolean)file_get_contents($request['url'], FALSE, NULL, 0, 1)) {
                $html = file_get_contents($request['url']);
            } else {
                $ch = curl_init($request['url']);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 ( .NET CLR 3.5.30729)');
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
                curl_setopt($ch, CURLOPT_TIMEOUT, 120);
                $html = curl_exec($ch);
                curl_close($ch);
            }

            $page = explode('<body', $html);
            preg_match_all($findElem, $page[1], $results);

            $elements = $request['selected'] == 'text' ? $results[0] : $results[1];

            if (count($elements) == 0) {
                throw new \Exception('По вашему запросу ни чего не найдено');
            }

            //Если найденные ссылки и картинки не содержат в начале адреса, то добавляем его
            if ($request['selected'] === 'links' || $request['selected'] === 'pictures') {
                foreach ($results[1] as $key => $elem) {
                    if (substr($elem, 0, 4) !== 'http')
                    $elements[$key] = $request['url'] . $elem;
                }
            }

            $elements = array_slice($elements, 0, 50);

            //Сделал ограничение для записи в БД
            if (strlen(json_encode($elements)) >= 10000) {
                $elements = $this->checkAndTrimArray($elements);
            }

            $elementsString = json_encode($elements);

            $data['url'] = $request['url'];
            $data['elements'] = $elementsString;
            $data['date'] = date("Y-m-d H:i:s");

            if (!$this->indexRepository->save($request['selected'], $data)) {
                throw new \Exception('Что то пошло не так');
            }

            //Это тоже стоило бы хранить в бд
            $data['elementsCount'] = count($elements);

            echo $this->json($data);
        } catch (\Exception $e) {
            echo $this->json(['error' => 'Ошибка: ' . $e->getMessage()]);
        }
    }

    /**
     * Функция-рекурсия для проверки и получения массива необходимой длинны
     */
    private function checkAndTrimArray(&$array) {
        if (strlen(json_encode($array)) < 10000) {
            return $array;
        } else {
            $shorterArray = array_splice($array, 5);
            return $this->checkAndTrimArray($shorterArray);
        }
    }

}
