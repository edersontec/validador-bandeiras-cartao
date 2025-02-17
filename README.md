# API simples para validação de bandeiras de cartão

## Índice

- [Sobre o projeto](#sobre-o-projeto)
- [Regras de validação](#regras-de-validação)
- [Funcionalidades](#funcionalidades)
- [Aprendizados](#aprendizados)
- [Tecnologias utilizadas](#tecnologias-utilizadas)
- [Pré-requisitos](#pré-requisitos)
- [Como instalar este projeto](#como-instalar-este-projeto)
- [Como usar este projeto](#como-usar-este-projeto)
- [Reflexão](#reflexão)
- [Contribuidores](#contribuidores)

## Sobre o projeto

Este projeto de API simples para validação de bandeiras de cartão é resultado de um exercício proposto no 'Bootcamp Microsoft AI for Tech - GitHub Copilot' feito em Fevereiro de 2025.

O objetivo é criar um validador de bandeiras de cartão de crédito com assistência do GitHub Copilot.

## Regras de validação

<div align="center">
    <img src="assets/bandeiras-cartao.jpg"/>
</div>

## Funcionalidades

- API simples para consulta de bandeira de cartão. Requisição protegida com Bearer Token (tipo de token usado para autenticação) 

## Aprendizados

- Funcionalidades do Slim (PHP micro framework)
- Padrão MVC
- Regex
- Middleware
- PSR-7 (padrão para modelar mensagens HTTP)
- Api protegida por Bearer Token
- Testes unitários
- Docker

## Tecnologias utilizadas

- [PHP](https://www.php.net/): Linguagem de programação
- [Slim Framework](https://www.slimframework.com/): Micro Framework PHP
- [GitHub Copilot](https://code.visualstudio.com/docs/copilot/overview): ferramenta de inteligência artificial desenvolvida pelo GitHub em conjunto com a OpenAI para auxiliar o desenvolvedor de software
- [Docker](https://www.docker.com/): tecnologia de conteinerização de aplicações

## Pré-requisitos

- [PHP](https://www.php.net/)
- [git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)

## Como instalar este projeto

1. Garanta que o PHP 8.3, git, Composer e Docker Compose estejam instalados

2. Clone o repositório: git clone https://github.com/edersontec/validador-bandeiras-cartao.git

### Caso escolha executar utilizando servidor embutido do PHP

3. Prepare as variáveis de ambiente:
    - O arquivo *env.example* é um arquivo de exemplo para auxiliar na instalação da aplicação, basta preencher as informações
    - Faça uma cópia de *env.example* e renomeie-a para *.env*
    - Crie um token de autenticação
        - Exemplo: BEARER_TOKEN="1234567890"

4. Baixe as dependências, execute os testes e inicie o servidor web:
    ```
    composer install && composer test && composer start
    ```

### Caso escolha executar utilizando ambiente Docker

3. Prepare as variáveis de ambiente:
    - Não é necessário nenhuma ação pois durante o build da imagem (arquivo Dockerfile) é adicionado um token de autenticação ao arquivo .env (para fins didáticos)

4. Inicie o servidor usando Docker Compose
    ```
    docker compose up
    ```

## Como usar este projeto

Realize uma requisição na API.

- Exemplo de requisição curl em linha de comando:

```sh
curl --location "http://localhost:8080/api/validarNumeroCartao" --header "Content-Type: application/json" --header "Authorization: Bearer 1234567890" --data "{\"numeroCartao\": \"4123456789012456\"}"
```

- Exemplo de retorno:

```json
{
    "numeroCartao": "4123456789012456",
    "valido": true,
    "bandeira": "Visa"
}
```

## Reflexão

A proposta foi utilizar os recursos do GitHub Copilot para geração de código com pouca intervenção do programador. Em geral ele teve êxito nas tarefas solicitadas, e não obteve êxito em outras (prompts mau formulados contribuíram para isso).

Penso que caberá ao programador "agir como piloto / ser o maestro / saber o que está fazendo / entender os princípios da boa programação", pois será necessário conhecimento para criar o prompt correto, validar o retorno gerado pela IA e fazer as adequações necessárias no código.

Repito: sempre valide o que IA gerar.

Penso que comunidades como Stack Overflow ainda serão de grande importância para questões mais específicas ou quando a IA começar a "viajar na maionese / ter alucinações / reescrever a mesma solução mais de uma vez"

### Processos em que GitHub Copilot agiu "com sucesso":

- criação da estrutura de pastas recomendada para uma API
- criação de rotas
- criação de Controller para validar número do cartão
- criação de funções regex a partir de documento explicativo
- criação de um middleware de autenticação usando Bearer tokens
- criação de estrutura para testes unitários
- criação de testes unitários básicos

### Processos em que GitHub Copilot agiu "com falha inicialmente":

- criação da lógica de negócio no Controller e não no Model
- capturar qualquer outra rota no framework Slim que não esteja definida e retornar uma mensagem personalizada em vez de apresentar uma exceção
- receber dados da API via JSON em vez de formulário (form-data)
- lógica para buscar variáveis de ambiente (.env)

## Contribuidores

Sinta-se livre para contribuir com o projeto

