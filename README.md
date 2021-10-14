# Teste prático para Desenvolvedores PHP - IClinic

Este teste foi realizado para à vaga de desenvolvimento PHP do Shosp. Foi utilizado Laravel como framework, visando segurança, performance e o padrão MVC. Foi utilizada a   biblioteca 'Laravel excel' como interface para importar o CSV. Mysql como banco de dados. 

**Documentação das tecnologias usadas:**
- https://laravel.com/docs/7.x
- https://docs.laravel-excel.com/3.1/getting-started/
- https://www.php.net/docs.php
- https://getbootstrap.com/docs/4.0/getting-started/introduction/



## Passo a Passo para rodar o projeto 

- Inicialemte executar <code>composer install</code>no diretório ../teste-pratico-dev-php/desafio-iclinic
- Alterar .env.example para .env | DB_DATABASE=iclinic | QUEUE_CONNECTION=database | QUEUE_DRIVER=database
- executar <code>php artisan key:generate</code> caso ainda não tenha uma key em APP_KEY=
- executar <code>php artisan config:clear</code>
- Com o schema criado no banco, e as credenciais no .env, executar <code>php artisan migrate --seed</code>
- executar <code>php artisan serve</code> 

## LEVANDO EM CONSIDERAÇÃO QUE O PROJETO FOI REALIZADO APENAS UM AMBIENTE DE DESENVOLVIMENTO, ARQUIVOS IGUAIS OU MAIORES QUE 500000 BYTES ESTÃO SENDO PROCESSADOS EM FILA, PARA TAL É NECESSÁRIO UTILIZAR UMA DIRETIVA NO TERMINAL : <code>php artisan queue:work</code> APÓS IMPORTAR ARQUIVOS GRANDES PARA QUE O MESMO SEJA PROCESSADO POR MEIO DE UMA "JOB" !

**O Laravel executa um trabalho de filas que são processadas na medida que um "job" é colocado na fila. Para manter o queue:work sendo executado permanentemente em background é necessário o Uso do Supervisor, como é um projeto realizado apenas em ambiente de desenvolvimento, se faz necessário executar <code>php artisan queue:work</code> após importar um arquivo CSV muito grande. VEJA EM :https://laravel.com/docs/7.x/queues#introduction **
