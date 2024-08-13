<?php 
namespace app\helpers;

function redirect(string $to)
{
    return header ("Location: {$to}");
}

?>