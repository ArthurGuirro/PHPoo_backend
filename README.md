
# Projeto PHP com MySQL - Aplicação Dockerizada

Este projeto é uma aplicação PHP utilizando a versão 8.1.29 e MySQL como banco de dados. A aplicação foi desenvolvida com base na playlist disponível no [YouTube](https://www.youtube.com/playlist?list=PLyugqHiq-SKdK8YjyV7x51IWZxpk9wVQN).

## Sumário

- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Rodando o Projeto](#rodando-o-projeto)
- [Gerenciamento de Banco de Dados](#gerenciamento-de-banco-de-dados)
- [Referências Importantes](#referências-importantes)
- [Contribuindo](#contribuindo)

## Pré-requisitos

Antes de iniciar, certifique-se de ter as seguintes ferramentas instaladas em seu ambiente:

- PHP 8.1.29
- Composer
- Docker
- MySQL
- [DBeaver](https://dbeaver.io/) (opcional, para gerenciamento do banco de dados)

## Instalação

1. Clone o repositório:

   ~~~bash
   git clone https://github.com/ArthurGuirro/PHPoo_backend.git
   cd PHPoo_backend
   ~~~

2. Instale as dependências do projeto com o Composer:

   ~~~bash
   composer install
   ~~~

   > **Nota:** Se houver alguma modificação no `composer.json`, execute o comando `composer dump-autoload` para atualizar o autoloader.

## Rodando o Projeto

1. Inicie o servidor PHP:

   ~~~bash
   php -S localhost:5000 -t public
   ~~~

   > **Importante:** Se você estiver rodando a aplicação em um ambiente Docker, troque as rotas e qualquer referência ao caminho `/phpoo_routes` para refletir a estrutura no Docker.

2. Acesse a aplicação no navegador:

   ~~~
   http://localhost:5000
   ~~~

## Gerenciamento de Banco de Dados

Recomenda-se o uso do [DBeaver](https://dbeaver.io/) para gerenciamento do banco de dados MySQL.

## Referências Importantes

- **URL Amigável:** Para implementar URLs amigáveis, siga as instruções fornecidas [nesta aula](https://www.youtube.com/watch?v=-PeSLuzEEuk).

- **SQL Injection:** A última aula da playlist discute uma brecha de SQL Injection. A correção será feita utilizando as melhorias do PHP 8.2. Recomenda-se fazer commits a cada etapa da implementação para facilitar o rollback em caso de problemas.

## Contribuindo

Contribuições são bem-vindas! Se você encontrar algum problema ou tiver sugestões, por favor, abra uma issue ou envie um pull request.

