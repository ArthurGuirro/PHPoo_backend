<?php 
namespace app\controllers;

use app\support\Email;
use app\support\Flash;
use app\support\Validate;

use function app\helpers\redirect;

class ContactController extends Controller
{
    public function index()
    {
       $this->view('contact',['title'=>'Contact']);
    }

    public function store()
    {
        $validate = new Validate;
        $validated = $validate->validate([
            'email' => 'email|required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        if(!$validated)
        {
            return redirect('/phpoo_routes/contact');
        }

       $email = new Email;
       //fluent interface = um método que chama outro
       $sent = $email   ->from($validated['email'], 'UNESPAR')
                        ->to('teste@gmail.com')
                        ->message($validated['message'])
                        ->template('contact',['name'=>'Arthur'])
                        ->subject($validated['subject'])
                        ->send();

        if ($sent)
        {
            Flash::set('sent_success', 'Email enviado com sucesso');
            return redirect('/phpoo_routes/contact');
        }
        Flash::set('sent_error', 'Ocorreu um erro ao enviar o email');
        return redirect('/phpoo_routes/contact');
        // dd($sent);
    }
}

?>