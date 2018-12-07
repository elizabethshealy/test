<?php /* Template Name: Blog Posts */ ?>

<?php get_header(); ?>

<?php
global $post; // не обязательно
$args = array('post_type' => 'posts'); // 5 записей из рубрики 9
$myposts = get_posts( $args );
foreach( $myposts as $post ){ setup_postdata($post);
    // стандартный вывод записей
}
wp_reset_postdata(); // сбрасываем переменную $post
?>

<?php get_footer(); ?>
