# API PRODUCTS


## SOBRE
Projeto faculdade de Analise e Desenvolivmento de Sistema, Desenvolver uma API de produtos criando todas as routes e funcoes.

## PASSO A PASSO
Para desenvolver essa nossa API precisamos ter instalado, PHP 8, Composer e Mysql. E necessario em nosso terminal rodar o seguinte arquivo composer create-project laravel/laravel ApiProducts.
```
composer create-project laravel/laravel --prefer-dist ApiProducts
```
Após feito isso devemos entra na pasta do projeto. 
```
cd ApiProducts
```
Em seguida vamos abrir o  editor de codigo e abrir o arquivo .env, esse arquivo serve para fazer a conexao do banco de dados, devemos altera os seguintes campos, DB_DATABASE= para o nome do seu banco, DB_USERNAME = para o nome do seu usuario e DB_PASSWORD = colocar a senha do seu banco caso tenha se nao deixa em branco.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<seuBancoAqui>
DB_USERNAME=<seuUsuarioDoBanco>
DB_PASSWORD=<senhaDoUsuarioDoBanco>

```
De volta no terminal vamos rodar um comando para criar a migration, a migration permite a criacao e manipulacao de bancos de dados.

```
php artisan make:migration create_ApiProducts_table
```
Em seguida vamos abrir o editor de codigo novamente para a gente inserir nossa tabela no banco, devemos ir na pasta database\migration e abrir a migration que acabamos de criar, assim podemos criar nossa tabela inserindo o seguindo codigo.
```
   public function up()
    {
        Schema::create('ApiProducts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->float('value');
            $table->boolean('status');
            
        });
    }

```
Feito isso  essa tabela nao foi criada no banco ainda, para mandarmos essa tabela para o banco devemos rodar o seguinte comando no terminal.
```
php artisan migration

```
Depois disso e so atualizar o banco que a tabela aparecera la.

Agora vamos criar o arquivo mais importante da nossa api, novamente vamos abrir o terminal e escrever o seguinte comando esse comando ele cria um arquivo com as funcoes criadas mais sem atributos.
```
php artisan make:controller Api\\ApiProducts --model=PRODUCTS --api
```

A partir de agora vamos comecar a criar as funcoes da nossa api, mais antes de tudo precisamos criar a route da api, para isso precisamos esta com o editor de codigo aberto ir na seguinte pasta routes\api.php. Ja dentro do arquivo vamos rodar o seguinte comando.
```
Route::apiResource('/apiproducts', ApiProducts::class);
```
Com esse comando ja geramos todas as rotas da nossa api.

Agora vamos para parte das funcoes da api, quando a gente rodou o comando para criar o arquivo das funcoes esse comando gerou um arquivo o nosso aqui e ApiProducts. Devemos entrar no editor de codigo abrir as seguintes pastas app\http\controllers dentro desse arquivo temos todas as funcoes criadas mais sem atributos nenhum igual do exemplo a seguir

```
  public function index()
    {
     //
    }

   public function store()
    {
     //
    }
   public function show()
    {
     //
    }
  public function update()
    {
     //
    }
  public function destroy()
    {
     //
    }


```
Apos esta com esse arquivo aberto vamos comecar a codificar o arquivo

```
     public function index()
    {
        $product = apiproducts::all();
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = apiproducts::create($request->all());

        return response()->json
            ([
                'message'=> 'Produto salvo',
                'product'=> $product
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\apiproducts  $apiproducts
     * @return \Illuminate\Http\Response
     */
    public function show(apiproducts $product)
    {
        return response()->json
           ([
               'message'=> 'Sucesso',
               'product'=> $product
           ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\apiproducts  $apiproducts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, apiproducts $product)
    {
        $product->update($request->all());
        return response()->json
             ([
               'message'=> 'Produto atualizado com sucesso',
               'product' => $product
             ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\apiproducts  $apiproducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(apiproducts $product)
    {
        $product->delete();

        return response()->json
           ([
               'message'=> 'Produto deletado com sucesso',
           ]);

     }
}
```
```
Antes de fazer alguma requisição, você precisa usar alguma plataforma que faz requisições, tal como, o postman, Apache JMeter etc. Após abrir sua plataforma de requisições que preferir podemos realmente utilizar a nossa API.
```
###### Adicionar Campo
Para fazermos uma insercao de dados, precisamos esta na plataforma de requisicoes, criar uma nova requisicao usar o metodos POST para inserir.

```bash
 {
        "name": "Blusa de frio",
        "description": "Blusa de frio nike corta vento",
        "value": 50.00,
    }
```
Depois de fazer a requisiçâo, esperamos a seguinte mensagem de retorno

```bash
{
    "message": "Produto criado com Sucesso",
    "product": {
        "name": "Blusa de frio ",
        "description": "Blusa de frio nike corta vento",
        "value": 50.00,
        
    }
}
```
Caso você não passar todos os parametros obrigatorios, dará a seguinte mensagem

```bash
{
    "message": "Sua requisição está faltando dados"
}
```

###### Editar Dados
Agora, para editar essas informações precisamos passar a seguinte URL http://localhost:8000/api/apiproducts/1. Repara que a unica diferença, é que temos que passar o id referênte ao produto na URL.

O processo é o mesmo. Você precisa passar os parametros que deseja mudar na requisiçâo. Por Exemplo

```bash
{
    "name": "Calca Nike",
    "value": 200.50,
    "description": "Alteracao feita no nome do produto e no valor",
}
```

Após fazer essa requisiçâo, temos a seguinte mensagem de Sucesso
```bash
{
    "name": "Calca Nike",
    "value": 200.50,
    "description": "Alteracao feita no nome do produco e no valor",
}
```

Caso não apareca aquela mensagem, não deu certo sua requisição e ela retornara uma mensagem de erro

```bash
{
    "message": "Sua requição está faltando dados"
}
```

###### Visualizar Dados
Bom, podemos visualizar os produtos cadastrados de duas formas

1. Listar todos os produtos.
2. Passar o id de cada produto e visualizar um por um.   

Para ver todos os produtos, você precisa acessar a seguinte URL http://localhost:8000/api/apiproducts. Nesse caso, não precisamos passar nenhum parametro para requisiçâo. Dessa forma conseguimos pegar todos os produtos cadastrados em nossa base de dados

```bash
[
    {
    "name": "Blusa de frio",
    "description": "Blusa de frio Nike corta vento",
    "value": 50.00,
    },
    {
        "name": "Calca Nike",
        "description": "Descrição do produto chocolate",
        "value": 200.50,
    }
]

```

Agora para pegar produto por produto, na nossa URL teremos que passar o id de do produto como parametro. http://localhost:8000/api/apiproducts/1

Dessa forma, conseguimos pegar os dados do primeiro produto.

```bash
{
    "message": "Sucesso",
    "product": {
        "id": 1,
        "name": "Calca Nike",
        "description": "Alteracao feita no nome do produto e no valor",
        "value": 1000.5,

    }
}
```

###### Excluir Dados
Agora para excluir algum produto, não muda muito a lógica. Precisamos apenas acessar a rota http://localhost:8000/api/apiproducts/ e passando o id do produto na URL, ficando dessa forma http://localhost:8000/api/apiproducts/1

Após fazer essa requisiçâo teremos a seguinte mensagem de retorno 

```bash
{
    "message": "Sucesso!! Item deletado"
}
```




