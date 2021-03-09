Criado importador, com base no framework symfony 5.2. 

Observações<br>

importar os arquivos csv exportados, para dentro da pasta public<br>
mudar os dados de conexão com o banco de dados mysql, no arquivo .env<br>
rodar o comando: bin/console doctrine:database:create, p/ criar o banco em questão(Se o banco já existir, apenas informa-lo no arquivo .env, e ignorar o comando de criação do banco)<br>
rodar o comando: bin/console doctrine:migrations:migrate, p/ crias as tabelas<br>
rodar o comando: bin/console doctrine:fixtures:load --append, p/ rodar a fixture<br>

P/ rodar o comando do importador: bin/console app:importador-ativos <nome-do-arquivo><br>
P/ obter ajudar, aplicar o seguinte comando:  bin/console app:importador-ativos --help<br>
