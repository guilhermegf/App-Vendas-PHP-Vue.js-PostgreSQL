<?php
/*
    * Autor: Gulherme Gonçalves de Freitas 
    * Data: 25/03/2023
    * Classe para testes de rotas e métodos na API de produtos e vendas
*/

require_once 'vendor/autoload.php';

class ApiTest extends PHPUnit\Framework\TestCase
{
    private $client;

    protected function setUp(): void {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8000/'
        ]);
    }

    public function testGetAllTiposProduto() {
        $response = $this->client->get('tipos_produto');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
    }

    public function testGetByIdTiposProduto() {
        $response = $this->client->get('tipos_produto/1');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('nome', $data);
        $this->assertArrayHasKey('imposto_percentual', $data);
    }

    public function testCreateTiposProduto() {
        $response = $this->client->post('tipos_produto', [
            'json' => [
                'nome' => 'Tipo de produto teste',
                'imposto_percentual' => 10
            ]
        ]);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testUpdateTiposProduto() {
        $response = $this->client->put('tipos_produto/3', [
            'json' => [
                'nome' => 'Tipo de produto teste atualizado',
                'imposto_percentual' => 20
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteTiposProduto() {
        $response = $this->client->delete('tipos_produto/4');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetAllProdutos() {
        $response = $this->client->get('produtos');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
    }

    public function testGetByIdProdutos() {
        $response = $this->client->get('produtos/6');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('nome', $data);
        $this->assertArrayHasKey('descricao', $data);
        $this->assertArrayHasKey('marca', $data);
        $this->assertArrayHasKey('quantidade_estoque',$data);
        $this->assertArrayHasKey('preco',$data);
        $this->assertArrayHasKey('tipo_id',$data);
    }

    public function testCreateProduto() {
        $response = $this->client->post('produtos', [
            'json' => [
                'nome' => 'Produto teste',
                'descricao' => 'Produto descricao teste',
                'marca' => 'Produto marca teste',
                'quantidade_estoque' => 5,
                'preco' => 10.20,
                'tipo_id' => 1
            ]
        ]);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testUpdateProdutos() {
        $response = $this->client->put('produtos/10', [
            'json' => [
                'nome' => 'Produto teste atualizado',
                'descricao' => 'Produto descricao teste atualizado',
                'marca' => 'Produto marca teste atualizado',
                'quantidade_estoque' => 15,
                'preco' => 0.50,
                'tipo_id' => 1
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteProdutos() {
        $response = $this->client->delete('produtos/1');
        $this->assertEquals(200, $response->getStatusCode());
    }  

    public function testGetAllVendas() {
        $response = $this->client->get('vendas');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
    }

    public function testGetByIdVendas() {
        $response = $this->client->get('vendas/3');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('data_hora', $data);
        $this->assertArrayHasKey('valor_total', $data);
        $this->assertArrayHasKey('valor_impostos', $data);
    }

    public function testCreateVendas() {
        $response = $this->client->post('vendas', [
            'json' => [
                'valor_total' => 100.00,
                'valor_impostos' => 15.00,
                'itens' => [
                    [
                        'produto_id' => 2,
                        'quantidade' => 1,
                        'preco_unitario' => 30.00,
                        'imposto_unitario' => 4.50
                    ],
                    [
                        'produto_id' => 3,
                        'quantidade' => 3,
                        'preco_unitario' => 12.00,
                        'imposto_unitario' => 1.80
                    ]
                ]
            ]
        ]);
        $this->assertEquals(201, $response->getStatusCode());
    }

    public function testUpdateVendas() {
        $response = $this->client->put('vendas/3', [
            'json' => [
                'valor_total' => 100.00,
                'valor_impostos' => 15.00,
                'itens' => [                    
                    [
                        'produto_id' => 2,
                        'quantidade' => 1,
                        'preco_unitario' => 30.00,
                        'imposto_unitario' => 4.50
                    ],
                    [
                        'produto_id' => 3,
                        'quantidade' => 3,
                        'preco_unitario' => 12.00,
                        'imposto_unitario' => 1.80
                    ]
                ]
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testDeleteVendas() {
        $response = $this->client->delete('vendas/1');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetAllItensVendaByVendaId() {
        $response = $this->client->get('itens_venda_venda_id/2');
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertIsArray($data);
    }
}
