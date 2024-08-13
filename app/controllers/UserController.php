<?php 
namespace app\controllers;

use app\controllers\Controller;
use app\core\Request;
use app\support\Csrf;
use app\support\Validate;
use app\database\models\User;

use function app\helpers\redirect;

class UserController extends Controller
{
    public function edit($params)
    {
        // $response = Request::query('page');
        // dd($response);

        $this->view(
            'user', 
            [
                'title'=>'Editar user'
            ]
        );
        
    }

    public function update($params)
    {   

        $validate = new Validate;
        $validated = $validate->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'email|required|unique:'.User::class,
            'password' => 'maxLen:6|required',
        ]);

        if(!$validated)
        {
            return redirect('/phpoo_routes/user/12');
        }

        // dd($validated);
        // Csrf::validateToken();
        // dd(Request::only(['email','firstName']));
    }

}
?>