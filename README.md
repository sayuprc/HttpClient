# HttpClient

勉強がてら作ったcURLのラッパークラス

## 使い方

```php
$client = new \HttpClient\Client();

$client->get(string $url, array $options = []): HttpResponse
$client->post(string $url, array $options = []): HttpResponse
```

## 使用例

```php
$client = new \HttpClient\Client();

$response = $client->get('http://example.com');

$statusCode = $response->getStatusCode();

$body = $response->getBody();
```

## オプション設定

|項目名|形式|概要|
|---|---|---|
|headers|array|リクエストヘッダの値。複数指定可能。|
|json|array|リクエストボディに設定される値|
|data|array|リクエストボディに設定される値|
|query|array|クエリ文字列に変換される配列|
|with_header|bool|レスポンスヘッダの取得(デフォルト: false)|

### headers

HTTPヘッダを設定します。

```php
$client->get(
  'http://example.com',
  [
    'headers' => [
      'Cache-Control: max-age=0',
    ],
  ]
);
```

### json

POSTで送信するデータです。

`json_encode()` を実行します。

```php
$client->post(
  'http://example.com',
  [
    'json' => [
      'hoge' => 'hogehoge',
      'fuga' => 'fugafuga',
    ],
  ]
);
```

### body

POSTで送信するデータです。

```php
$client->post(
  'http://example.com',
  [
    'body' => [
      'hoge' => 'hogefuga'
    ],
  ]
);
```

### query

配列を基にクエリ文字列を生成します。

```php
// http://example.com?hoge=hogehoge&fuga=fugafuga
$client->get(
  'http://example.com',
  [
    'query' => [
      'hoge' => 'hogehoge',
      'fuga' => 'fugafuga',
    ],
  ]
);
```

### with_header

レスポンスヘッダを取得します。

```php
$client->get('http://example.com', ['with_header' => true]);
```