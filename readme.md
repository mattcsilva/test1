<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

# Projeto teste com laravel + Vue JS

## Baixar o projeto
Primeiro passo, clonar o projeto:
``` bash
# Clonar
git clone https://github.com/mattcsilva/test1.git

# Acessar
cd test1
```

## Configuração

``` bash
# Instalar dependências do projeto
composer install

# Configurar variáveis de ambiente
ren .env.example .env
php artisan key:generate

# Criar banco de dados
php artisan db:create

# Criar migrations
php artisan migrate
```

## Aplicação
``` bash
# Rodar aplicação
php artisan serve
```
