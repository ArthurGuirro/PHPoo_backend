<?php

use function app\helpers\flash;

 $this->layout('master', ['title'=>$title])?>

<h1>User</h1>
<?php echo flash('created')?>

<form action="/phpoo_routes/user/update" method="post">

    <?php echo getToken();?>

    <?php echo flash('firstName', 'color:red')?>
    <input type="text" name="firstName" value="Arthur"><br>

    <?php echo flash('lastName', 'color:red')?>
    <input type="text" name="lastName" value="Guirro"><br>

    <?php echo flash('email', 'color:red')?>
    <input type="text" name="email" value="a@a.com"><br>

    <?php echo flash('password', 'color:red')?>
    <input type="password" name="password" value="1234"><br>

    <button type="submit">Atualizar</button>
</form>