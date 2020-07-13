<?php
namespace App\Core;

/**
 * Интерфейс для репозиториев
 */
interface Repository
{
    public function getAll(); // получение всех записей
    public function getById($tableName, $id); // получение записи по id
    public function save($tableName, $data); // добавление новой записи
}
