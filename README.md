# match

マッチングアプリのリポジトリです。

## Overview

## 環境

-   Laravel 6.18
-   MySQL 5.7
-   Redis 5.0.4
-   Docker 18.09.6

## Installation
-   clone

```bash
$ git clone https://github.com/Kaikawa1028/match.git
```

- install

```
$ make install
```

-   コンテナの状態を確認

```bash
$ make ps
```

-   ローカル開発用 URL を開き動作確認

URL: http://localhost:80

- テストユーザー

```
男性
ID: test@gmail.com
pass: password
```

```
女性
ID: test-w@gmail.com
pass: password
```

## How to

-   コンテナの状態を確認する

```php
$ make ps
```

-   コンテナを起動する

```
$ make up
```

-   コンテナを停止する

```
$ make stop
```

-   コンテナのログを見る

```php
$ docker logs -f match_app
$ docker logs -f match_mysql
```

-   DB を migrate する

```php
$ make migrate
```

-   DB にシードデータを入れる

```php
$ make seed
```

- Dev環境でコマンドを実行

Note: [awscli](https://github.com/arsaga-partners/kurasel-server/wiki/awscli%E3%82%A4%E3%83%B3%E3%82%B9%E3%83%88%E3%83%BC%E3%83%AB%E6%96%B9%E6%B3%95), [fargatecli](https://github.com/arsaga-partners/kurasel-server/wiki/fargatecli%E3%82%A4%E3%83%B3%E3%82%B9%E3%83%88%E3%83%BC%E3%83%AB%E6%96%B9%E6%B3%95) のインストールが必用

```php
e.g. $ make remote-exec-dev php artisan route:list
e.g. $ make remote-exec-dev php artisan db:seed
```

修正する場合も同様に手動またはfactoryでDBにデータ注入後iseedでSeederファイルを生成する

キャッシュをクリアする

```php
$ php artisan optimize:clear
```

### push前にやること

-   テストが通っていることを確認しましょう

```
$ make test
```
