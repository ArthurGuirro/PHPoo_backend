<?php 
namespace app\routes;

class Routes
{
    public static function get()
    {
        return[
            'get'=>[
                '/phpoo_routes/'=>'HomeController@index',
                '/phpoo_routes/user/[0-9]+'=>'UserController@edit',
                '/phpoo_routes/product/[a-z]+/category/[a-z]+'=>'ProductController@show',
                '/phpoo_routes/register'=>'RegisterController@store',
                '/phpoo_routes/contact'=>'ContactController@index',
            ],
            'post'=>[
                '/phpoo_routes/user/update'=>'UserController@update',
                '/phpoo_routes/contact'=>'ContactController@store',
            ]
        ];
    }
}
?>