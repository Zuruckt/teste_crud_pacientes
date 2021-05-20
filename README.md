# Teste Laravel

## Requisitos
Para rodar essa aplicação você precisará do PHP ^8.0, Composer e MySQL. Além disso, são necessárias as extensões do PHP para utilizar o framework Laravel 8, você pode conferir elas [aqui](https://laravel.com/docs/7.x/installation#server-requirements).

## Instalação
Após clonar o repositório para sua máquina, entre em seu diretório e instale as dependências usando o composer: 
```sh
$ composer install
```

Depois disso, copie o arquivo `.env.example` para `.env` e gere a chave da aplicação:
```sh
$ cp .env.example .env
$ php artisan key:generate
```

Use este comando para criar um link simbolico na pasta de armazenamento
```sh
$ php artisan storage:link
```

Crie um banco de dados MySQL e insira os detalhes da conexão no arquivo `.env`:
```dotenv
DB_DATABASE=example_database
DB_USERNAME=example_user
DB_PASSWORD=qwe123
```

Após isso, rode as migrations para inserir as tabelas e rodar os seeders no banco:
```sh
$ php artisan migrate --seed
```

## Rodando o servidor

Utilize o seguinte comando para iniciar o servidor:
```sh
$ php artisan serve
```