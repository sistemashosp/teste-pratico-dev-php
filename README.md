# Teste prático para Desenvolvedores PHP

Este é o teste prático para candidatos à vaga de desenvolvimento PHP do Shosp.

**Requisitos:**
- Domínio da Linguagem PHP
- Javascript (jquery e ajax)
- Interpretação de texto
- Banco de dados Postgres

**Desejável:**
- Programação orientada a objetos
- MVC
- Javascript e Ajax

## Objetivo

A partir da descrição do teste, codificar em PHP os requisitos enumerados levando em conta a segurança da aplicação, performance, boa organização de código e documentação.

## Descrição do teste

Criar tabelas no banco de dados baseado nas colunas do arquivo csv. São duas tabelas com relacionamento 1:n "TIPO SANGUINEO" e "PACIENTE"

Escrever um código no arquivo cadastrar.php onde fará a leitura do arquivo pacientes.csv e cadastrará no banco de dados, de acordo com o Modelo de Entidade e Relacionamento. Esse código deverá sempre que for executado, APAGAR todos os dados e cadastrar novamente.

Escrever o código no arquivo listar.php que fará a leitura dos dados no banco de dados e mostrará na tela em forma de tabela, com mesmo layout do arquivo CSV.

A tabela deve ter as seguintes colunas:
- **PACIENTE:** Nome, Sobrenome, CPF, Email, Data Nascimento, Genero, Id do Tipo Sangúineo, Endereco, Cidade, Estado e CEP
- **TIPO SANGUÍNEO:** ID e Descrição

Veja o modelo: https://bit.ly/38RiyM1

Para cada registro, caso o CPF, Email e Data de Nascimento não sejam válidos, não deve preencher a coluna.

Todos os arquivos estão neste branch

## Banco de dados

Você pode usar um banco de dados local. Você pode utilizar Postgres ou Mysql, de acordo com sua preferência

Seguem os script de criação das tabelas para [Mysql](https://drive.google.com/file/d/1q0d4L7xTytDAft50L-SL9orcRq6r7bA1/view?usp=sharing) e [Postgres](https://drive.google.com/file/d/1M5xA1pX5Qyys-yR5CDcDlMpYKJHDW3Ht/view?usp=sharing)

## Avaliação

Demonstrar habilidade em escrever programas com linguagem PHP utilizando conexão com banco de dados Postgresql.

- Validação de dados
- Otimização de código
- Tratamento de erros
- Controle de segurança de dados
- Garantia de integridade de dados
- Manutenção de dados em Banco de Dados

## Prazo

O tempo disponibilizado para o teste é de:
- **24 horas**

## Entrega:

Para começar, faça um fork deste repositório, crie uma branch com o seu nome completo e depois envie-nos o pull request. Se você apenas clonar o repositório não vai conseguir fazer push e depois vai ser mais complicado fazer o pull request.

Caso ainda não tenha se cadastrado, acesse https://app.pipefy.com/public/form/cE1e8WsR para se cadastrar para a vaga.

## Dica do GIT

Neste vídeo ensina como você pode fazer o Fork do nosso repositório e entregar com o push request. https://youtu.be/gJCwWlB3XX0

# Sucesso!!!!
