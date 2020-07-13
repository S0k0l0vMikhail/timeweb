<?php
namespace App\Models;

use App\Core\DB;
use App\Core\Repository;

/**
 * Модель
 */
class IndexRepository implements Repository
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getDB();
    }

    public function getAll()
    {
        // возвращает все картины
        $sql = 'SELECT * FROM links';
        return $this->db->getAll($sql);
    }

    public function getAllByTable($tableName)
    {
        // получаем картину по id
        $sql = 'SELECT * FROM ' . $tableName;
        return $this->db->getAll($sql);
    }

    public function getById($tableName, $id)
    {
        // получаем картину по id
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id=:id';
        $params = [ 'id' => $id ];
        return $this->db->paramsGetOne($sql, $params);
    }

    public function save($tableName, $params)
    {
        $sql = 'INSERT INTO ' . $tableName . '
                (url, elements, date)
                VALUES (:url, :elements, :date)';
        return $this->db->nonSelectQuery($sql, $params);
    }
}
