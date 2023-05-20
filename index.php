<?php
require __DIR__."/config.php";
require __DIR__."/App/Database.php";
require __DIR__."/App/Reddit.php";
$Reddit = new \App\Reddit();

$title = "Título a ser publicado";

$text = "Texto a ser publicado"; //opcional

$url = ""; // opcional


$subreddit = ""; // a subreddit na qual deseja publicar
                 // NÃO coloque / ou /r apenas a subreddit pura, ex: brasil

$url = $Reddit->doPost($subreddit, $title, $text, $url);

if($url){
    echo "Seu post foi publicado na URL: <a target='_blank' rel='noopener noreferrer' href=\"$url\">$url</a>";
}else{
    echo "Não foi possível obter a URL, é possível que o post não tenha sido feito";
}