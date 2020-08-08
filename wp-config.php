<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'postcss_sample_database2' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'postcss_sample_user' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'postcss_sample_password' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'u}fZj]L7bPHJ6*0xB01CRr <SA`nV:%B=H!+gnC/IJ,U0lIkT(3c~n,u0?GkMq{l' );
define( 'SECURE_AUTH_KEY',  'u8M#;Ht$<i)t8{*P#lt%p0Lx1wSl]YE@n5@Z74-I4:h6fA /%ka,i#iL[ t/o@Jj' );
define( 'LOGGED_IN_KEY',    'e?<pD B:VXk%)Fr:4W]2[cJNn:(YB#Yu)D$lnt1{o&ZDW[.[7!cWl>E|]Pc6KB)l' );
define( 'NONCE_KEY',        'y?_7o(XjDH6Qo=1.qMM%{=#1]nsRSwhvSOac$JF(adILbpvuV?@%uV|a})@E _#X' );
define( 'AUTH_SALT',        '@6yy+uDMD.{h[Ag/}7iuP3cO. ALs?sI2IPjGq9q:}4aFtJB&8rncQ_b(hZjV>ZZ' );
define( 'SECURE_AUTH_SALT', 'A`x8b+]Ce&@=#m|Of>mF1a/xM?SznLpw_fpn;CGP3@[firh[=)jucjK$P[c)N0P9' );
define( 'LOGGED_IN_SALT',   'Kg@,W@2RlJA?>zPu,SUXT%kBORrJwfr0`P-Gouf}t`w_83]`SMT[!(dRslP6{!,y' );
define( 'NONCE_SALT',       '5OAXDmcjeL[%F_ltJdKP7eG/:f/a71z,x^0R2(c+ja?^PpFQR;jw0(4N[gH(*orX' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
