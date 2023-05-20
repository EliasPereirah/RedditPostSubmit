# RedditPostSubmit
Essa classe é simple e permite envio de postagens para o Reddit com PHP.

This class is simple and allows posting to Reddit using PHP.

Essa é uma classe PHP simples e eficiente para facilitar o envio de novos posts para o Reddit.

Ela fornece uma interface intuitiva e fácil de usar para interagir com a API do Reddit e postar conteúdo diretamente de sua aplicação.

Nesse diretório você encontra um [arquivo SQL](https://raw.githubusercontent.com/EliasPereirah/RedditPostSubmit/main/rd_token.sql) o qual pode ser utilizado como modelo para guardar o token gerado pela API.

Isso porque para fazer as postagens no Reddit além de todos os dados fornecidos no arquivo config.php você irá precisar de um token que tem validade de 24 horas.

Essa classe vai gerar o token automaticamente.

Armazenando os dados em um banco de dados como está implementado aqui irá renvoar o token automaticamente depois de 24 assim que uma nova requisão de postagem for realizada.


Depois de [criar seu app aqui https://www.reddit.com/prefs/apps](https://www.reddit.com/prefs/apps)

E inserir as informações no arquivo config, você está pronto para usar.

# Exemplo de uso

```php
<?php
require __DIR__."/config.php";
require __DIR__."/App/Database.php";
require __DIR__."/App/Reddit.php";
$Reddit = new \App\Reddit();

$title = "Título a ser publicado";
$text = "Texto a ser publicado"; //opcional
$url = ""; // URL é opcional
$subreddit = ""; // a subreddit na qual deseja publicar
                 // NÃO coloque / ou /r apenas a subreddit pura, ex: brasil
$url = $Reddit->doPost($subreddit, $title, $text, $url);
if($url){
    echo "Seu post foi publicado na URL: <a target='_blank' rel='noopener noreferrer' href=\"$url\">$url</a>";
}else{
    echo "Não foi possível obter a URL, é possível que o post não tenha sido feito";
}
```
