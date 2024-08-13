<?php

use function app\helpers\flash;

 $this->layout('master', ['title'=>$title])?>

<h1>Contato</h1>
<?php echo flash('sent_success','color:green')?>
<?php echo flash('sent_error','color:red')?>

<form action="/phpoo_routes/contact" method="post">
    <?php echo flash('email')?>
    <input type="text" name="email" id="" placeholder="email" value="a@a.com">
    <?php echo flash('subject')?>
    <input type="text" name="subject" id="" placeholder="subject" value="a">
    <?php echo flash('message')?>
    <textarea name="message" id="" cols="30" rows="10">ab</textarea>

    <?php echo getToken();?>

    <button type="submit">Send</button>
</form>