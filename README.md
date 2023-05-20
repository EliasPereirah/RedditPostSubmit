# RedditPostSubmit
Essa é uma classe PHP simples e eficiente para facilitar o envio de novos posts para o Reddit.

Ela fornece uma interface intuitiva e fácil de usar para interagir com a API do Reddit e postar conteúdo diretamente de sua aplicação.

Nesse diretório você encontra uma arquivo SQL o qual pode ser utilizado como modelo para guardar o token gerado pela API.

Isso porque para fazer as postagens no Reddit além de todos os dados fornecidos você irá precisar de um token que tem validade de 24 horas.

Armazenando os dados em um banco de dados como está implementado aqui irá renvoar o token automaticamente depois de 24 assim que uma nova requisão de postagem for realizada.

