<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
      <div class="wrapper__home">
        <h1>WordPressにPostCSSを導入してみた</h1>
        <figure class="wrapper__home--logo">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-wordpress.svg" alt="WordPress-Logo">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-postcss.svg" alt="PostCSS-Logo">
        </figure>
        <p>モダンなCSS開発環境として注目されているPostCSSを、WordPressに導入してみました。</p>
        <p>詳しい導入方法や、入れているプラグインはRepositoryにまとめておきましたので、詳しくはRepositoryをご覧ください。</p>
        <div class="link--button__wrapper">
          <a href="https://github.com/cookboys/sample-postcss-wordpress" class="link--button" target="_blank">Repositoryを見る</a>
        </div>
        <h2>イラストについて</h2>
        <p>フリーのデザイナー・漫画家・イラストレーターとして活躍されている、<a href="https://llminatoll.github.io/" target="_blank">湊川あい</a>さんにPostCSSのイメージキャラクターを描いていただきました！</p>
        <figure class="postcss__illust--wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/postcss-illust.png" alt="PostCSS-Illust">
        </figure>
      </div>

		<?php
		if ( have_posts() ) {

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content' );
			}

			// Previous/next page navigation.
			twentynineteen_the_posts_navigation();

		} else {

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php
get_footer();
