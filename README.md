# crawler-marvel


Funciona com servidor próprio do laravel(php artisan serve).



## Começando

Clone o repositório do projeto:

opção 1: 
Caso você use HTTPS:

git clone https://github.com/dompossebon/crawler-marvel.git

opção 2:
Caso você use SSH:

git clone git@github.com:dompossebon/crawler-marvel.git

---------------------------------------------------------

Após a clonagem, entre no diretório da aplicação: 

cd crawler-marvel

em seguida execute o comandos abaixo:

composer install
Caso aconteça erro de permissão, lembre-se de executar: (sudo chown -R $USER .) dentro do diretorio /bussolasocial
e então repita o comando (composer install)

Na raiz do projeto localize e Duplique o arquivo .env.example e em seguida renomeie-o para .env usando o comando:

cp .env.example .env


---------------------------------------------------------


Então rode o comando:

- php artisan key:generate


e em seguida

- php artisan serve

Agora basta

visite http: // http://127.0.0.1:8000/ para ver o aplicativo em ação.


---------------------------------------------------------

Para Rodar Testes rode este comando


## vendor/bin/phpunit


---------------------------------------------------------


## Construído com
Laravel - O framework PHP para artesãos da Web


## by Possebon 
## Contato dompossebon@gmail.com

:+1: ## By Possebon

