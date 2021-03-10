Criado importador de csv, usando como base o framework Symfony 5.2

Observações<br>

Clonar o repositório, e após isso, entrar no projeto clonado, e instalar dependências via composer<br>
Copiar/mover  os arquivos csv exportados, para dentro da pasta public/<br>
Mudar os dados de conexão com o banco de dados mysql, no arquivo .env<br>
Rodar o comando: bin/console doctrine:database:create, p/ criar o banco em questão(Se o banco já existir, apenas informa-lo no arquivo .env, e ignorar o comando de criação do banco)<br>
Rodar o comando: bin/console doctrine:migrations:migrate, p/ aplicar a migration e criar as tabelas<br>
Rodar o comando: bin/console doctrine:fixtures:load --append, p/ rodar a fixture<br><br>

Utilizar o comando do importador: bin/console app:importador-ativos <nome-do-arquivo><br>
Para obter ajuda, aplicar o seguinte comando no terminal: bin/console app:importador-ativos --help<br>
