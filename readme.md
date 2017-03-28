Sistema de Horários
--------
Sistema de controle de horários escolares para a empresa ACME (fictícia).

## Requisitos
 - XAMPP, WAMPP, LAMPP, EasyPHP e similares, ou instalação na mão do PHP e MySQL.
 - [Composer](https://getcomposer.org/)

## Instalação
Ao clonar, vá até a pasta do projeto, e execute no console:
````
composer install
````
Logo após:
````
php artisan serve
````
Eentre então no seu navegador em `localhost:8000`

# Padrões (Convenções)
## Nomenclatura
  - Nomes de rotas, rotas e métodos de rotas devem coincidir e devem ser verbos e ter seus nomes no singular:  
    **Ex:** Route::name('turno.***cadastrar***')->get('turno/***cadastrar***', 'TurnoController@***cadastrar***');
    **Obs:** Perceba, todos utilizam o nome "cadastrar" e "turno".

  - O ***index*** é uma exceção, pois é a lista, este deve estar no plural no nome, e o index é omitido no nome e na rota também:  
    **Ex:** Ex: Route::name('***turnos***')->get('***turnos***/', 'TurnoController@***index***');

  - O mesmo também vale para as ***views***, devem estar contidas dentro da **pasta com o nome do modelo** e os arquivos devem estar como **verbos no singular**, sendo apenas o index a exceção;

  - Nomes dos métodos no **controller** e sufixos de rotas (baseados na convenção em inglês, a frente está o método de request):
    - **index**: Lista de resultados, página inicial; `(GET)`
    - **cadastrar**: Form de cadastro; `(GET)`
    - **salvar**: Método que põe o valor do form no banco; `(POST)`
    - **editar**: Form de edição; `(GET)`
    - **atualizar**: Atualiza os dados no banco; `(PATCH)`
    - **deletar**: Remove do banco de dados; `(DELETE)`
    - **Obs:** Os demais métodos devem seguir este padrão, sendo sempre verbos;

## Pastas fora do padrão
 - **App/Helpers**: Esta pasta guarda arquivos que contém apenas funções que poderão ser executadas em qualquer local do projeto;