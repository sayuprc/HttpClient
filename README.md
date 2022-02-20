# HttpClient

勉強がてら作ったcURLのラッパークラス

## 使い方

```php
$client = new \HttpClient\Client();

$response = $client->get('http://example.com'); // GETリクエスト
// $response = $client->post('http://example.com'); // POSTリクエスト

$statusCode = $response->getStatusCode();

$body = $response->getBody();
```

### リクエストヘッダーの設定

ヘッダーは配列で複数指定可能

```php
$client = new \HttpClient\Client();

$response = $client->get(
  'http://example.com',
  [
    'headers' => [
      'Cache-Control: max-age=0',
    ],
  ]
);
```

### リクエストクエリ

```php
$client = new \HttpClient\Client();

$response = $client->get(
  'http://example.com',
  [
    'query' => [
      'hoge' => 'hogehoge',
      'fuga' => 'fugafuga',
    ],
  ]
);
```

### JSONリクエスト

```php
$client = new \HttpClient\Client();

$response = $client->post(
  'http://example.com',
  [
    'json' => [
      'hoge' => 'hogehoge',
      'fuga' => 'fugafuga',
    ],
  ]
);
```
