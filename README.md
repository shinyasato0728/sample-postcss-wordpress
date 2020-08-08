# Version

* PHP version 7.3.11

* MySQL version 8.0.12

* Apatch version 2.4.41

* Node.js version 12.13.1

* WordPress version 5.4.2

macOS上での開発環境の構築手順を示す。

## Homebrewのインストール

```
# インストールする
/usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"

# 確認する
$ brew -v
#> Homebrew 1.2.3
#> Homebrew/homebrew-core (git revision 7212; last commit 2017-07-02)
```

## nodebrewのインストール

```
# インストールする
$ curl -L git.io/nodebrew | perl - setup

# パスを通す
# ~/.bash_profileに追加
export PATH=$HOME/.nodebrew/current/bin:$PATH

# node.jsのインストール可能なバージョンを確認する
$ nodebrew ls-remote

# node.js v9.6.1のインストール
$ nodebrew install-binary v9.6.1

# 確認する
$ nodebrew ls
v9.6.1

current: none

# node.jsをセットアップする
$ nodebrew use v9.6.1

# 確認する
$ node -v
v9.6.1
```

## yarnのインストール
```
$ brew install yarn
```

## yarn installの実行
```
$ yarn install
```

## ローカルサーバーを立ち上げる
```
$ yarn start
```

---

# WordPressの環境構築

MAMPは使わず、全てコマンドラインから環境を構築していきます。

## Apatchの設定を変更する

[こちらのページの通り](https://github.com/ttskch/php-abc-quests/blob/master/01-environments/install-apache-php.md#setup-apache)に設定して、Apatchの設定を変更していきます。

## Apatchを起動する

ターミナルから、Apatchを起動します。

```
# apacheを起動する
$ sudo apachectl start

# apacheを終了する
$ sudo apachectl stop

# apacheを再起動する
$ sudo apachectl restart
```

## MySQLのインストール、サーバー起動

Homebrewを使って、MySQLをインストールします。

```
# HomebrewからMySQLをインストール（バージョン指定）
$ brew install mysql@8.0.12

# MySQLフォルダの権限を変更
$ chown -R _mysql:_mysql /usr/local/var/mysql

# MySQLサーバ起動
$ sudo mysql.server start

# MySQLサーバが動いてるか確認
$ mysqladmin ping

# MySQLサーバを止める
$ mysql.server stop
```

## MySQLでデータベース、ユーザー作成

ターミナルから、MySQLを操作して、データベースとユーザーを作成していきます。

MySQLは8.0から、新たに追加された認証プラグイン(caching_sha2_password)がデフォルトであてがわれるようになりました。

その為、ユーザーを追加する際は、旧式の認証プラグインである(mysql_native_password)を指定する必要があります。

```
# mysqlの操作を開始する
$ mysql -u root -p

# mysqlのルート権限のパスワード入力(デフォルトは空白)
Enter password: 

# ユーザ作成
mysql> create user 'postcss_sample_user'@'localhost' identified with mysql_native_password by 'postcss_sample_password';

# データベース作成
mysql> create database postcss_sample_database;

# ユーザにデータベース操作の権限追加
mysql> grant all privileges on postcss_sample_database.* to 'postcss_sample_user'@'localhost';

# データベース一覧で作ったデータベースがあるか確認する
mysql> show databases;

# ユーザ一覧で作ったユーザがあるか確認する
mysql> SELECT User, Host FROM mysql.user

# ついでにmysql.sockの場所を確認しておく
mysql> status
--------------
mysql  Ver 14.14 Distrib 5.6.23, for osx10.10 (x86_64) using  
　：
UNIX socket:        /tmp/mysql.sock   <- これを覚えておく

# mysqlの操作を終了する
mysql> quit
```

## php.iniを作成

php.iniを作り、アクセス権も変えます。

```
#php.ini.defaultをコピーしてphp.ini作成
$ sudo cp /etc/php.ini.default /etc/php.ini

#ファイルのアクセス権を設定
$ sudo chmod 644 /etc/php.ini
```

## php.iniのソケットファイルのパスを変更

以下の該当箇所の空欄に、MySQLのソケットファイルのパスを指定します。

```
mysql.default_socket = /tmp/mysql.sock
pdo_mysql.default_socket = /tmp/mysql.sock
mysqli.default_socket = /tmp/mysql.sock
```

## WordPressをダウンロード

[こちらからWordPressの最新版をダウンロードして](https://ja.wordpress.org/download/)、Apatchの設定で変更したディレクトリにコピーしましょう。

## PHPのビルトインウェブサーバーを起動

以下のコマンドを入力して、PHPのビルトインウェブサーバーを起動しましょう。

```
$ php -S localhost:8000
```

## WordPressのインストール

[こちらから](http://localhost:8000/)ローカルサーバーにアクセスすると、インストール画面が出ます。

MySQLで作成した、データベース・ユーザー名・パスワードを入れていきます。

* データベース名：sample_postcss_database

* ユーザ名：sample_postcss_user

* パスワード：sample_postcss_password

* データベースのホスト：localhost

* テーブル接頭辞：wp_

### 参考

[MacでWordPressをローカルインストールする(MAMPなし, phpmyadminなし)](https://qiita.com/himitech/items/342235828a4c2513dd4d)

---

# PostCSSの環境構築

標準でwebpackがインストールされていないので、今回は簡単にPostCSSの設定ができる、postcss-cliを使って環境を構築していきたいと思います。

## postcss-cliをインストール

```
$ yarn add postcss-cli
```

## PostCSSのプラグインインストール

どのようなプラグインでも良いですが、このRepositoryには以下のプラグインが入っています。

* autoprefixer
  * 自動的にベンダープレフィックスをつけてくれる。

* postcss-import
  * PostCSSでimportが使えるようになる。

* postcss-apply
  * 策定中のCSSの仕様に乗っ取って、変数・関数を指定することができる。

```
/* postcss.css */
:root {
  --radius: 4px;

  --my-style: { display: flex; background: #ffffff;};
}

.foo { border-radius: var(--radius);}
.bar { @apply --my-style;}

/* build.css */
.foo { border-radius: 4px;}
.bar { display: flex; background: #ffffff;}
```

* postcss-nesting
  * PostCSSで入れ子が使えるようになる。ルールは[最新の入れ子](https://tabatkins.github.io/specs/css-nesting/)と同じルールが適用される。

* postcss-css-reset
  * normalize.cssに基づいたreset.cssが使えるようになる。

* postcss-color-function
  * PostCSSでcolor関数が使えるようになる。

```
/* postcss.css */
.f__color { color: color(#000 a(50%)); background-color: color(#000 l(40%)); border-color: color(#fff b(50%));}

/* build.css */
.f__color { color: rgba(0.0.0.0.5); background-color: rgb(102,102,102); border-color: rgb(170, 170, 170);}
```

* postcss-flexbugs-fixes
  * flexboxのバグを取り除いてくれる。

* postcss-custom-media
  * @mediaに名前をつけることができる。

```
/* postcss.css */
@custom-media --smartphone (max-width: 600px);
.media { width: 100%;
  @media(--smartphone) { width: 95%;}
}

/* build.css */
.media { width: 100%;
  @media (max-width: 600px) { width: 95%;}
}
```

* postcss-media-minmax
  * @mediaのmax-width,min-widthを不等号で指定することができる。

```
/* postcss.css */
@media (width <= 960px) { width: 50%;}
@media (width => 600px) { width: 100%;}

/* build.css */
@media (max-width: 960px) { width: 50%;}
@media (min-width: 600px) { width: 100%;}
```

* postcss-pixels-to-rem
  * 全てのpixelを、rem,emに自動的に変換する。

以下のコマンドを実行して、プラグインをインストールします。

```
$ yarn add autoprefixer postcss-import postcss-apply postcss-nesting postcss-css-reset postcss-color-function postcss-flexbugs-fixes postcss-custom-media postcss-media-minmax postcss-pixels-to-rem
```

## 設定を記載する

ルートディレクトリに「postcss.config.js」を作成して、読み込むプラグインを記載していきます。

プラグインは上から下に読み込まれるので、順番は非常に重要です。

```
module.exports = (ctx) => ({
  map: ctx.options.map,
  plugins: [
    require('autoprefixer')({ browsers: ['> 1%', 'last 2 versions', 'Opera >=10.1', 'Firefox >= 4', 'iOS >=3.2'] }),
    require('postcss-import'),
    require('postcss-apply'),
    require('postcss-nesting'),
    require('postcss-css-reset'),
    require('postcss-color-function'),
    require('postcss-flexbugs-fixes'),
    require('postcss-custom-media'),
    require('postcss-media-minmax'),
    require('postcss-pixels-to-rem')
  ]
});
```

## PostCSS用のディレクトリと、書き出し用のディレクトを作成する

ルートディレクトリに、「postcss」というディレクトリを作成。ここに、PostCSSで記載したcssファイルを作成していきます。

WordPressのテーマに、PostCSSを通したcssファイルを吐き出すディレクトリを作成します。

## package.jsonにスクリプトを記載する

PHPのビルトインウェブサーバーと、PostCSSの読み込み・書き出しを一度に行うスクリプトを記載します。

```
"scripts": {
  "start": "php -S localhost:8000 & postcss postcss/*.css -d wp-content/themes/sample-postcss/assets/css/ -w"
},
```

## 実行する

設定が終わったら、以下のコマンドを実行して、WordPressとPostCSSを起動してみましょう。

```
$ yarn start
```
