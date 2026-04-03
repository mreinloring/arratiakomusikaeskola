<?php get_header(); ?>

<div class="container">
    <div class="page-wrap">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Ez dago edukirik / No hay contenido.</p>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
