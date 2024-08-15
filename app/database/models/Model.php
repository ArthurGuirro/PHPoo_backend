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
    private ?Filters $filters;
    private string $pagination = '';

    protected string $table;

    public function setFields($fields)
    {
        $this->fields = $fields;
    }

    public function setFilters(Filters $filters)
    {
        $this->filters = $filters;
        // var_dump($this->filters);
    }

    public function setPagination (Pagination $pagination)
    {
        // var_dump($this->count());
        // dd($this->count());
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

            //var_dump($sql);

        } catch (PDOException $e) {
            var_dump($e->getMessage());
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
            var_dump($e->getMessage());
        }
    }

    public function fetchAll()
    {
        try {
            $table = $this->getTable();
            $sql = "select {$this->fields} from {$table} {$this->filters?->dump()} {$this->pagination}";
            
            $connection = Connection::connect();
        
            $prepare = $connection->prepare($sql);

            $prepare->execute($this->filters ? $this->filters->getBind() : []);

            //var_dump($prepare);

            return $prepare->fetchAll(PDO::FETCH_CLASS);

        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
    abstract protected function getTable(): string;

    public function findBy(string $field='', string $value='')
    {
        try {
            $table = $this->getTable();
            $sql = (empty($this->filters)) ?
                "select {$this->fields} from {$table} where {$field} = :{$field}" :
                "select {$this->fields} from {$table} {$this->filters?->dump()}";           //se der ruim, voltar no 13:20

            $connection = Connection::connect(); 
            $prepare = $connection->prepare($sql);
            $prepare->execute($this->filters ? $this->filters->getBind() : [$field=>$value]);

            return $prepare->fetchObject();
            
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function first($field = 'id', $order = 'asc')
    {
        try {
            $table = $this->getTable();
            $sql = "select {$this->fields} from {$table} order by {$field} {$order}";

            $connection = Connection::connect(); 
            $query = $connection->query($sql);

            return $query->fetchObject();

        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function delete(string $field = '', string|int $value = '')
    {
        try {
            $table = $this->getTable();
            $sql = (!($this->filters)) ?
            "delete from {$table} {$this->filters}" :
            "delete from {$table} where {$field} = :{$field}" ;

            //var_dump($sql);

            $connection = Connection::connect(); 
            $prepare = $connection->prepare($sql);
            return $prepare->execute(empty($this->filters) ? [$field=>$value] : $this->filters->getBind()); 
            
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }

    public function count()
    {
        try {
            $table = $this->getTable();
            $sql = "select {$this->fields} from {$table} {$this->filters?->dump()}";

            $connection = Connection::connect(); 

            // dd($connection);
            $prepare = $connection->prepare($sql);
            $prepare->execute($this->filters ? $this->filters->getBind() : []);

            return $prepare->rowCount();

        } catch (PDOException $e) {
            var_dump($e->getMessage()); 
        }
    }
}

?>