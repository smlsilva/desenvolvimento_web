# API, REST E RESTFULL

# O que é uma API (Interface de Programação e Aplicações) ?

- Exemplo
  * Cliente (client)
  * Garçom (pedidos, levar seus pedidos para a cozinha) (API)
  * Cozinha (servidor)

- Responsável por estabelecer uma comunicação entre diferentes serviços.
- Meio de campo entre as tecnologias
- Intermediador para trocas de informações

# O que é uma API Rest (Transferência de Estado Representativo)?

A transferência de dados, geralmente, usa o protocolo HTTP.

O Rest, delimita algumas obrigações nessas transferências de dados.
    | - Resources seria então, uma entidade, um objeto

## 6 Necessidades (constraints) para ser RestFul.

- _Client-Server_: Separação do cliente e do armazenamento de dados (servidor),
dessa forma, poderemos ter uma portabilidade do nosso sistema, usando React
para Web e React Native para o Smartphone, por exemplo.

- _Stateless_: Cada requisição que o cliente faz para o servidor, deverá conter
todas as informações necessárias para o servidor entender e responder (RESPONSE) 
a requisição (REQUEST).
    Exemplo: A sessão do usuário deverá ser enviada em todas as requisições,
    para saber se aquele usuário está autenticado e apto a usar os serviços,
    e o servidor não poder lembrar que o cliente foi autenticado na requisição anterior.
    Geralmente é usado Tokens para informar se o usuário está autenticado ou não.

- _Cacheable_: As respostas para uma requisição, deverão ser explicitas ao dizer se 
aquela requisição, pode ou não ser cacheada pelo cliente.

- _Layered System_: O cliente acessa o endpoint, sem precisar saber da complexidade,
de quais passos estão sendo necessários para o servidor responder a requisição,
ou quais outras camadas o servidor estará lidando, para que a requisição seja 
respondida.

- _Code on demand (OPCIONAL)_: Dá a possibilidade da nossa aplicação pegar códigos,
como o javascript, por exemplo, e executar no cliente.

# O que é Restful

RESTful, é a aplicação dos padrões REST.

# Boas práticas:

- Utilizar verbos HTTP para nossas requisições
- Utilzar plural ou singular na criação dos ENDPOINTs ? _Não importa!_ use um padrão
- Não deixa barra no final do endpoint
- Nunca deixe o cliente sem resposta

### VERBOS HTTP

GET: Receber os dados de um Resource
POST: Enviar os dados ou informações para serem processados por um Resource
PUT: Atualizar os dados de um Resource
DELETE: Deletar um Resource

### STATUS DA RESPOSTA

- https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Status