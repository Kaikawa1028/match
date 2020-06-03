# match

マッチングアプリのリポジトリです。

## Overview

## 環境

-   Laravel 6.18
-   MySQL 5.7
-   Redis 5.0.4
-   Docker 18.09.6

## インフラ構成

- [こちらを参照](https://github.com/Kaikawa1028/match_infra) 

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

- キャッシュをクリアする

```php
$ php artisan optimize:clear
```

### push前にやること

-   テストが通っていることを確認しましょう

```
$ make test
```
