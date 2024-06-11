<?php get_header();

while(have_posts()){
    the_post(); ?>

<div class="container pt-3">
    <h1> <?php the_title(); ?> </h1>
    <hr />

<div class="px-5 py-5">
    <?php the_content(); ?>
</div>

</div>


    <?php 
}
?>