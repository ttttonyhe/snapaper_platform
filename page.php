<?php get_header();?>
<div class="site-content uk-animation-slide-bottom-small">
	<div class="content-area">
		<main class="site-main">
		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class( 'page' ); ?>>
				<div class="container small">
					<div class="entry-wrapper">
						<div class="entry-content u-text-format u-clearfix">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</article>
		<?php endwhile;?>
		</main>
	</div>
</div>
<?php get_footer();?>