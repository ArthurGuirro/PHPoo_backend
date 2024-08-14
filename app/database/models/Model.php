<?php 
namespace app\database\models;

use app\database\Connection;
use app\database\Filters;
use app\database\Pagination;
use PDO;
use PDOException;

abstract class Model
{
    private string $fields = '*';
    private string $filters = '';
    private string $pagination = '';

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function setFilters(Filters $filters)
    {
        $this->filters = $filters->dump();
    }

    public function setPagination (Pagination $pagination)
    {
        $pagination -> setTotalItems($this->count());
        $this->pagination = $pagination->dump();
    }

    public function create(array $data)
    {
        try {
            $table = $this->getTable();
            $sql = "insert into {$table} (";
            $sql .= implode(',', array_keys($data)).") values(";
            $sql .= ':'.implode(',:', array_keys($data)).")";

            $connection = Connection::connect(); 
            $prepare = $connection->prepare($sql);
            return $prepare->execute($data);

            //dd($sql);

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function update(string $field, string|int $fieldValue, array $data)
    {
        try {
            $table = $this->getTable();
            $sql = "update {$table} set ";
            foreach ($data as $key => $value) {
                $sql.="{$key} = :{$key},";
            }

            $sql = rtrim($sql, ',');

            $sql .= " where {$field} = :{$field}";

            $data[$field] = $fieldValue;

            $connection = Connection::connect(); 
            $prepare = $connection->prepare($sql);
            return $prepare->execute($data);
            
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function fetchAll()
    {
        try {
            $table = $this->getTable();
            $sql = "select {$this->fields} from {$table} {$this->filters} {$this->pagination}";

            $connection = Connection::connect();

            $query = $connection->query($sql);

            //dd($query);

            return $query->fetchAll(PDO::FETCH_CLASS, get_called_class());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }
    abstract protected function getTable(): string;

    public function findBy(string $field='', string $value='')
    {
        try {
            $table = $this->getTable();
            $sql = (empty($this->filters)) ?
                "select {$this->fields} from {$table} where {$field} = :{$field}" :
                "select {$this->fields} from {$table} {$this->filters}";

            $connection = Connection::connect(); 
            $prepare = $connection->prepare($sql);
            $prepare->execute(!$this->filters ? [$field=>$value] : []);

            return $prepare->fetchObject(get_called_class());
            
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function first($field = 'id', $order = 'asc')
    {
        try {
            $table = $this->getTable();
            $sql = "select {$this->fields} from {$table} order by {$field} {$order}";

            $connection = Connection::connect(); 
            $query = $connection->query($sql);

            return $query->fetchObject(get_called_class());

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function delete(string $field = '', string|int $value = '')
    {
        try {
            $table = $this->getTable();
            $sql = (!($this->filters)) ?
            "delete from {$table} {$this->filters}" :
            "delete from {$table} where {$field} = :{$field}" ;

            //dd($sql);

            $connection = Connection::connect(); 
            $prepare = $connection->prepare($sql);
            return $prepare->execute(($this->filters) ? [$field=>$value] : []); 
            
        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }

    public function count()
    {
        try {
            $table = $this->getTable();
            $sql = "select {$this->fields} from {$table} {$this->filters}";

            $connection = Connection::connect(); 
            $query = $connection->query($sql);

            return $query->rowCount();

        } catch (PDOException $e) {
            dd($e->getMessage());
        }
    }
}

?>