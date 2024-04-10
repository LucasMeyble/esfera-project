
# Introdução à documentação do projeto TODO LIST


## Passo a passo para rodar o projeto
Clone Repositório
```sh
git clone https://github.com/LucasMeyble/esfera-project.git
```
```sh
cd esfera-project/
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=EspecializaTi
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

Vá no arquivo .Dockerfile e mude as variaveis

```sh
ARG user=seu_user
ARG uid=1000
```
Para saber seu user basta digitar no terminal 
```sh
id 
```
e o retorno esperado é aglo do tipo **uid=1000(lucas)**.

Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Acessar o projeto
[http://localhost:8989](http://localhost:8989)


Para rodar os teste basta rodar o comando php artisan test no terminal
```sh
php artisan test
```
* * *

## Rotas do projeto

**POST** - login
description: Lidar com uma tentativa de autenticação.
parameters: 
```sh
[
    'email' => email_user
    'password' => password
]   
```
response: redirect route tasks.index

**GET|HEAD** - logout
description: Lidar com uma tentativa de deslogar do sistema.
parameters: 
```sh
nenhum
```
response: redirect route auth.index

**GET|HEAD** - tasks
description: Exibir uma listagem do recurso.
parameters: 
```sh
$request 
    [
        'title' => 'titulo da task',
        'status_id' => 'status da task' 
    ]
```
response: redirect route auth.index com os dados filtrados.

**POST** - tasks
description: Armazene um recurso recém-criado no banco de dados.
parameters: 
```sh
$request 
    [
        'title' => 'titulo da task',
        'description' => 'descrição da task' 
    ]
```
response: redirect route auth.index com os dados filtrados.

**GET|HEAD** - tasks/create
description: Mostre o formulário para criação de um novo recurso.
parameters: 
```sh
nenhum
```
response: retorna a view new_task.

**GET|HEAD** - tasks/delete/{id}
description: Remova o recurso especificado do banco de dados.
parameters: 
```sh
$id = id_task
```
response: redirect route auth.index com os dados filtrados.

**GET|HEAD** - tasks/{task_id}/alter_status/{status_id}
description: Altera o status conforme a ação feita.
parameters: 
```sh
$task_id = id_task;
$status_id = new_status_id; 
```
response: redirect route auth.index com os dados filtrados.

**GET|HEAD** - tasks/{task}
description: Mostra a vizualização dos dados da task.
parameters: 
```sh
$task = id_task;
```
response: retorna a view view_task.

**PUT|PATCH** - tasks/{task}
description: Atualize o recurso especificado no banco de dados.
parameters: 
```sh
$request 
    [
        'title' => 'titulo da task',
        'description' => 'descrição da task' 
    ];
    
$task = id_task;
```
response: redirect route auth.index com os dados filtrados.

**GET|HEAD** - tasks/{task}/edit
description: Mostra a vizualização dos dados da task.
parameters: 
```sh
$task = id_task;
```
response: retorna a view edit_task.
