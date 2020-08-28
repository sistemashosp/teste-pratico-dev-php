# Teste prático para Desenvolvedores PHP

Este é o teste prático para candidatos à vaga de desenvolvimento PHP do Shosp.

#MEU CÓDIGO PARA SHOSP

Obs: Fiz um vídeo bem resumido como “não-listado” no youtube, segue o link: 

https://youtu.be/ha9-qXJzxaA


Abaixo tentarei explicar em passos como tentei resolver o teste proposto:

1º – Na tabela CSV que foi encaminhada, não havia o ID do tipo sanguíneo, por essa razão optei por utilizar o nome do tipo sanguíneo diretamente.

2º – A tabela possuía 50 mil linhas e eu não tive capacidade de processamento ou código avançado o suficiente para tratar toda essa quantidade de dados. O que consegui com meu código foi tratar por vez, de 500 a 1000 linhas, sem que a aplicação travasse.

3º – Utilizei como ferramentas o VsCode, Xampp, MySql (Banco de dados do próprio Xampp) e o phpoffice/phpspreadsheet como recurso.

4 º – Utilizei a estrutura MVC para tratar essa demanda. Como Model eu precisei utilizar apenas “Paciente” com a devida abstração do Banco de Dados e as funções necessárias para salvar o arquivo de upload, ler esse arquivo transformando os dados de cada linha em um array e então inserindo no banco de dados.

5º – Na camada de Views eu utilizei somente a view “index” para receber o arquivo para upload na forma de um “form/HTML” e uma segunda view para listar todos os pacientes do banco de dados em forma de tabela HTML.

6º – Na camada de Controller utilizei apenas 1 controller denominado IndexController para tratar todas as rotas e disparar as devidas actions com os devidos códigos.

7º - Apenas uma observação, tive de colocar a pasata Vendor no gitignore pelo seu tamanho e quantidade muito grande de arquivos.

Creio que existam maneiras sim de inserir uma quantidade muito grande de dados em uma tabela do MySql com um conhecimento mais avançado tanto do PHP quanto do próprio MySQl, ou uma carga horária maior para resolução do problema com muitas linhas.

Mesmo não tendo alcançado o exito completo, fico feliz de ter chegado onde cheguei dentro dessa aplicação e agradeço a Shosp pela chance de demonstrar meu trabalho. Recomendo também o vídeo listado no início desse documento para uma explicação com voz e vídeo mais detalhada.
