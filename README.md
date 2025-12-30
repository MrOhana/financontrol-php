# FinanControl

## Sobre o Projeto

O **FinanControl** é uma aplicação completa de controle financeiro desenvolvida para auxiliar usuários no gerenciamento de suas finanças pessoais. O sistema permite o cadastro e acompanhamento detalhado de receitas, despesas e metas financeiras, oferecendo uma visão clara da saúde financeira.

### Funcionalidades Principais

*   **Gestão de Transações**:
    *   **Despesas**: Cadastro detalhado incluindo nome, categoria, tipo (fixa/variável), valor e data. Suporte para lançamentos retroativos.
    *   **Receitas**: Registro de entradas financeiras com classificação por categoria e tipo (fixa/variável).
*   **Gerenciamento de Metas**: Criação de metas financeiras (ex: viagens, bens), com suporte a metas de longo prazo (sem data de término definida).
*   **Autenticação e Segurança**:
    *   Cadastro e login de usuários.
    *   Proteção de senhas utilizando hash Argon2.
    *   Sistema de recuperação de senha via e-mail.
*   **Categorização**: Organização de despesas e receitas através de categorias personalizáveis.

## Tecnologias Utilizadas

O projeto utiliza uma stack moderna e robusta, seguindo boas práticas de desenvolvimento e arquitetura:

*   **Backend**:
    *   **PHP**: Linguagem base da aplicação.
    *   **Laravel**: Framework PHP utilizado para estrutura MVC, rotas, segurança e orquestração.
    *   **Eloquent ORM**: Camada de abstração de banco de dados.
    *   **PostgreSQL**: Banco de dados relacional.
*   **Frontend**:
    *   **Livewire**: Framework full-stack para Laravel que permite interfaces dinâmicas sem a complexidade de SPAs.
    *   **Alpine.js**: Utilizado para interatividades JavaScript leves e pontuais.
    *   **Tailwind CSS**: Framework CSS utility-first para estilização da interface.
*   **Testes**:
    *   **PHPUnit**: Framework para execução de testes unitários e de integração.

## Pré-requisitos

Para rodar o projeto localmente, você precisará ter instalado:

*   **PHP** (versão 8.2 ou superior)
*   **Composer** (Gerenciador de dependências do PHP)
*   **Node.js** e **NPM** (Para compilação dos assets do frontend)
*   **PostgreSQL** (Servidor de banco de dados)

## Como Rodar Localmente

Siga os passos abaixo para configurar e executar a aplicação em seu ambiente de desenvolvimento:

1.  **Clone o repositório**
    ```bash
    git clone <URL_DO_REPOSITORIO>
    cd financontrol-php
    ```

2.  **Instale as dependências do Backend (PHP)**
    ```bash
    composer install
    ```

3.  **Instale as dependências do Frontend (Assets)**
    ```bash
    npm install
    npm run build
    ```

4.  **Configure o Ambiente**
    Faça uma cópia do arquivo de exemplo de configuração e renomeie para `.env`:
    ```bash
    cp .env.example .env
    ```
    Abra o arquivo `.env` e configure as credenciais do seu banco de dados PostgreSQL:
    ```env
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=financontrol
    DB_USERNAME=seu_usuario
    DB_PASSWORD=sua_senha
    ```

5.  **Gere a Chave da Aplicação**
    ```bash
    php artisan key:generate
    ```

6.  **Execute as Migrations**
    Crie as tabelas no banco de dados:
    ```bash
    php artisan migrate
    ```

7.  **Inicie o Servidor Local**
    ```bash
    php artisan serve
    ```

8.  **Acesse a Aplicação**
    Abra seu navegador e acesse: `http://localhost:8000`

## Estrutura do Projeto

O projeto segue as convenções de arquitetura do Laravel, com ênfase na separação de responsabilidades:

*   `app/Models`: Definição das entidades e relacionamentos (User, Goal, Expense, ExpenseCategory, Income).
*   `app/Services`: Lógica de negócios isolada dos controladores.
*   `resources/views`: Templates Blade e componentes Livewire.
*   `tests`: Testes automatizados para garantir a integridade da aplicação.
