<?php 
namespace app\database\models;

use app\database\models\Model;

class User extends Model
{
    protected string $table = 'users';

    public function getTable(): string
    {
        return $this->table;
    }


}
?>
