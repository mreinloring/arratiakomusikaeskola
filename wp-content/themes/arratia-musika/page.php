<?php get_header(); ?>

<div class="container">
    <div class="page-wrap">
        <?php while (have_posts()): the_post(); ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
