# News Management

Acesso: https://suresmilecloud.com/ <br> <br>
Acesso Admin: https://suresmilecloud.com/login <br>
Usuário: investidor10@investidor10.com.br <br>
Senha: investidor10 <br>

## Back-End 
Php / Laravel 11 / Inertia.js

## Front-End
Vue.Js

*******************

# Instruções para Instalação 


## Instalação do Docker
```bash
# Site de instalação oficial do docker:
https://docs.docker.com/engine/install/
```

## Instalação do PHP
```bash
# O primeiro passo para instalar diferentes versões do PHP
# É adicionar o PPA mantido por Ondrej Surý no Ubuntu
~ sudo add-apt-repository ppa:ondrej/php

# Agora, é preciso que você atualize o sistema
~ sudo apt-get update

# Troque o *.* pela versão do PHP que você deseja. Exemplo:
# php7.4-fpm, php8.1-fpm...
# No projeto usamos a 8.3
~ sudo apt install php*.*-fpm

# Agora você pode instalar os módulos mais necessários,
# Basta trocar a versão pela do PHP ou das versões que você quer instalar.
~ sudo apt install openssl php*.*-curl php*.*-gd php*.*-imagick php*.*-mbstring php*.*-common php*.*-bcmath
~ sudo apt install php*.*-xml php*.*-zip php*.*-mysql php*.*-intl php*.*-mongodb php*.*-gmp php*.*-soap
```

## Instalação do Composer
```bash
# Siga os passos do site oficial e faça a instalação global
https://getcomposer.org/download/
```

## Instalação do Takeout
```bash
# Faça a instalação do Takeout através do repositório oficial:
# https://github.com/tighten/takeout ou siga os comandos baixo:
~ composer global require tightenco/takeout

# Em seguida verifique o caminho da instalação do composer
# E no arquivo ~/.bashrc adicione a seguinte linha no final do arquivo:
export PATH=~/.config/composer/vendor/bin:$PATH

# Verifica se a configuração foi bem sucedida:
~ source ~/.bashrc
# Após rodar os comandos feche a sessão do terminal e abra novamente para
# Executar a ativação dos serviços

# Em seguida vamos ativar os serviços:
takeout enable mysql
takeout enable redis
takeout enable mailhog
```

## Instalação do Node
```bash
# Siga os comandos abaixou o acesse a documentação oficial (https://github.com/nodesource/distributions/blob/master/README.md)
# Caso não esteja usando Linux Ubuntu.
~ curl -fsSL https://deb.nodesource.com/setup_21.x | sudo -E bash - &&\
~ sudo apt-get install -y nodejs
```

## Instalação do NPM
```bash
# Instalar
~ sudo apt install npm

# Verificar versão
~ npm -v

# Atualizar
~ npm install -g npm@latest
```

## Instalação do NVM
#### (Caso a versão do seu node seja inferior a v18)
```bash
# Siga a instalação e configuração oficial:
https://github.com/nvm-sh/nvm
```

## Instalação do Projeto
```bash
# Clone o projeto do nosso repositório via SSH
~ git clone git@github.com:rbombonatti/news_management.git

# Acesse a pasta do projeto
~ cd news_management

# Instala as dependências do via composer
~ composer install

# Instala as dependências do via npm
~ npm install

# Clona o arquivo .env-example
~ cp .env-example .env

# Gera a chave
~ php artisan key:generate

# Gera link simbólico
~ php artisan storage:link

# Rode as migrations
# (após configurar no .env os dados do banco de dados)
~ php artisan migrate
```

## Executando o Projeto
```bash
# Ativar os containers
~ takeout start --all

# Desativar os containers
~ takeout stop --all

# Executar servidor PHP, expondo-o em http://127.0.0.1:8000
~ php artisan serve

# Executar o node
~ npm run dev
```

## Executando as Seeders do Projeto
```bash
# Essa Seed vai gerar as informações necessárias para o banco de dados
php artisan db:seed --class=StartSeeder

# Essa Seed vai gerar as reações
php artisan db:seed --class=ReactionSeeder
```
