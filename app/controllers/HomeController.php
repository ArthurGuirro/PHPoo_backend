<?php
namespace app\controllers;

use app\controllers\Controller;
use app\database\Filters;
use app\database\models\User;
use app\database\Pagination;

class HomeController extends Controller
{
    public function index()
    {   

        // $arr = ['name'=>'Robson','color'=>'red'];
        // $uri=http_build_query(array_merge($arr, $_GET));
        // dd($uri);

        $filters = new Filters;
        $filters->where('users.id', '>', 1);
        // $filters->join('posts', 'users.id', '=', 'posts.userId', 'left join');

        $pagination = new Pagination;
        $pagination->setItemsPerPage(1);
        
        $user = new User;
        $user->setFields('users.id,firstName,lastName');
        $user->setFilters($filters);
        $user->setPagination($pagination);
        $usersFound = $user->fetchAll();

        // dd($usersFound);

        $this->view('home', ['title' => 'Home', 'users' => $usersFound, 'pagination' => $pagination]);//error 12:50
    }
}

?>