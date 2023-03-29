Sistemas de vendas

-----------------------------------------------------------------------------------
- Dump do banco PostgreSQL da aplicação com criação das tabelas e inserts iniciais.
arquivo apivendas.sql
-----------------------------------------------------------------------------------
- Modulo API /apiphp7
API desenvolvida com PHP 7.4 nativo, sem uso de frameworks, seguindo o PSR-2.
A API possui uma documentação sobre suas rotas presentes em apiphp7/README.
Ela pode ser inicilizada com:
cd apiphp7
php -S localhost:8000
-----------------------------------------------------------------------------------
- Módulo teste API /testeapi7
Testes unitários automatizados para API utilizando o PHPUnit 9.6. 
A classes de testes fica em tests/ApiTest.php
Nela foram implementados métodos para testar as rotas da API.
Pode ser executado com:
cd testeapi7
composer install
vendor/bin/phpunit
Os testes foram preparados conforme DUMP inicial do banco apivendas.sql
-----------------------------------------------------------------------------------
- Módulo frontend com Vue.js, usando bootstrap e seguindo recomendações de material
design.
Os arquivos fontes estão em /src.
Nesse Caso necessário:
npm install.
npm run serve

O build está disponível em /dist/

Nesse frontend há três menus:
- Tipos de Produtos
Cadastro de tipos de produtos, com opção para adicionar, remover e editar. Sendo que só é
possível remover tipos de produtos ainda não utilizados por produtos.
- Produtos
Cadastro de produtos, com opção para adicionar, remover e editar. Sendo que só é
possível remover produtos ainda não utilizados em alguma venda.
- Vendas
Cadastro das vendas, com opção para adicionar ou visualizar.




