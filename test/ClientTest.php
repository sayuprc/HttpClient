<?php

namespace test;

use HttpClient\Client;
use HttpClient\ClientException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = new Client();
    }

    /**
     * リクエスト成功したときのHTTPステータスコード
     */
    public function testGetResponseStatusCode()
    {
        $expected = 200;

        $response = $this->client->get('http://localhost/public/get/200.php');

        $actual = $response->getStatusCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * リクエスト成功したときのレスポンスボディ
     */
    public function testGetResponseBody()
    {
        $expected = 'GET Response';

        $response = $this->client->get('http://localhost/public/get/200.php');

        $actual = $response->getBody();

        $this->assertEquals($expected, $actual);
    }

    /**
     * 存在しないファイルをリクエストしたときのHTTPステータスコード
     */
    public function testGetNotFound()
    {
        $expected = 404;

        $response = $this->client->get('http://localhost/public/get/404.php');

        $actual = $response->getStatusCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * エラーが起きたときのHTTPステータスコード
     */
    public function testGetInternalError()
    {
        $expected = 500;

        $response = $this->client->get('http://localhost/public/get/500.php');

        $actual = $response->getStatusCode();

        $this->assertEquals($expected, $actual);
    }

    /**
     * パラメータ付きGETリクエスト
     */
    public function testGetRequestWithParams()
    {
        $expected = 'param value';

        $response = $this->client->get(
            'http://localhost/public/get/with-param.php',
            [
                'query' => ['value' => 'param value'],
            ]
        );

        $actual = $response->getBody();

        $this->assertEquals($expected, $actual);
    }

    /**
     * `Content-Type: application/json`でPOSTリクエスト
     */
    public function testPostRequestWithParams()
    {
        $expected = '{"value":"json value"}';

        $response = $this->client->post(
            'http://localhost/public/post/json.php',
            [
                'headers' => ['Content-Type: application/json'],
                'json' => ['value' => 'json value'],
            ]
        );

        $actual = $response->getBody();

        $this->assertEquals($expected, $actual);
    }

    /**
     * URLが空のとき例外が発生する
     */
    public function testClientException()
    {
        $this->expectException(ClientException::class);
        $this->client->get('');
    }

    /**
     * レスポンスヘッダも取得する
     */
    public function testWithHeader()
    {
        $expected = 'HTTP/1.1 200 OK';

        $response = $this->client->get(
            'http://localhost/public/get/200.php',
            ['with_header' => true,]
        );

        $actual = $response->getHeaders()[0];

        $this->assertEquals($expected, $actual);
    }
}
