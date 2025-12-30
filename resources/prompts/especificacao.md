### OBJETIVO
Construa uma aplicação utilizando que seja um controle financeiro onde eu posso cadastrar metas e lançar minhas receitas e minhas despesas.

### REQUISITOS TECNICOS
1- A aplicação deve ser construida em PHP
2- A aplicação deve ser construida em Laravel como backend
3- A aplicação deve ser capaz de acessar um banco de dados PostgreSQL
4- A aplicação deve usar o Eloquent ORM para interagir com o banco de dados
5- A aplicação deve ser capaz de gerar logs 
6- Utilize o Livewire para criar componentes de frontend da aplicação
7- Utilize o Alpine.js para quando o Livewire não for suficiente e você precisar de javascript, ou seja, só use o Alpine se for estritamente necessário e o Livewire não for suficiente.
8- Utilize o Tailwind CSS para estilizar a aplicação

### REQUISITOS FUNCIONAIS
1- O sistema deve permitir que eu cadastre uma despesa lançando o nome, a categoria, se é uma despesa fixa ou variável, o valor e a data da despesa, 
porque eu posso lançar despesas retroativas.
2- O sistema deve permitir que eu cadastre uma receita lançando o nome, a categoria, se é uma receita fixa ou variável, o valor e a data da receita, 
porque eu posso lançar receitas retroativas.
3- Ao cadastrar metas, eu posso informar metas com data fim vazia, ou seja, serão metas de longo prazo que ainda não terei visibilidade da realização.
4- Ao entrar na aplicação devo ver uma tela de login onde eu devo entrar com o usuário e a senha.
5- Caso eu ainda não possua cadastro, o sistema deve permitir que eu realize um cadastro, informando o nome, email e senha.
6- A senha do cliente deve ser criptografada usando hash Argon2 e um salt aleatório.
7- O sistema deve permitir que eu recupere minha senha, informando o email cadastrado.
8- O sistema deve enviar um email para o email cadastrado com um link para recuperação de senha.

### ENTIDADES DE MODELO
1- User
Cadastra os usuários que irão utilizar a aplicação

Campos:
- name
- email (unique)
- password
- created_at
- updated_at
- status (ACTIVE, INACTIVE)

2- Goal
Cadastra as metas macro que queremos alcançar, como por exemplo, realizar uma viagem, trocar de carro, mudar de casa, etc.

Campos:
- name
- description
- start_date
- end_date
- created_at
- updated_at

3- ExpenseCategory
Cadastra as categorias que as despesas serão classificadas sempre que forem lançadas

Campos:
- name
- description
- created_at

4- Expense
Cadastra as despesas que serão lançadas sempre que forem lançadas

Campos:
- name
- description
- value
- date
- category_id
- goal_id
- created_at

5- Income
Cadastra as receitas que serão lançadas sempre que forem lançadas

Campos:
- name
- description
- value
- date
- category_id
- created_at

### REQUISITOS DE SEGURANÇA
1- O sistema **NÃO DEVE** expor chaves, senhas e demais dados sensíveis.
2- O sistema deve utilizar o Laravel para autenticar e autorizar os usuários.
3- O sistema deve utilizar o Laravel para proteger as rotas da aplicação.
4- O Sistema deve utilizar o Laravel para authorização de rotas de usuários comuns e administradores.

### IMPORTANTE
1- O sistema deve ser capaz de ser executado em uma máquina virtual.
2- O Sistema deve ser todo programado em Inglês.
3- Execute todos os testes unitários na camada que contém a lógica de negócios.

### BOAS PRÁTICAS DE ARQUITETURA
1- Controladores devem ser finos, delegando a lógica para camadas de serviço.
2- Separe rotas em arquivos distintos (web.php, api.php, channels.php, console.php) para evitar arquivos gigantes e conflitos.
3- Mova a lógica de negócios dos controladores para classes de serviço. Use Injeção de Dependência para injetar serviços e repositórios, tornando o código mais testável.
4- Divida apps grandes em módulos menores para melhor manutenção e escalabilidade, usando pacotes ou serviços independentes. 
5- Use with() (eager loading) para evitar o problema de N+1 consultas.
6- Use escopos nos modelos para organizar e reutilizar consultas complexas.
7- Sempre use migrations para versionar e gerenciar o esquema do banco de dados. 
8- Escreva testes unitários e de integração para garantir a qualidade do código.
9- Siga padrões RESTful (endpoints claros, nomes consistentes). 

### BOAS PRÁTICAS DE SEGURANÇA
1- Use middleware para autenticação, autorização e validação de requisições.
2- Garanta proteção contra CSRF e utilize prepared statements (padrão no Laravel) para evitar SQL Injection.
3- Acesse via arquivos de configuração (config/) e não diretamente com env() após o cache, para performance. 

