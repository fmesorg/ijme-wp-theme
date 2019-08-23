<?php get_header(); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Blogs</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">

</head>
<body>

<div class="container background-white margin-top-5">

    <div class="jumbotron overlay-darker">
        <h1 class="featured-title">Hello, world!</h1>
        <p class="featured-abstract">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
        <p class="featured-abstract"><a href="<?php the_permalink();?>">Continue Reading...</a></p>
    </div>

    <div class="sub-featured-container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="thumbnail sub-featured-post">
                <div class="padding-sub-featured">
                    <div class="blog-post-summary">
                        <strong class="d-inline-block mb-2 text-primary">Category</strong>
                        <h3 class="mb-0"><a href="<?php the_permalink(); ?>"><?php
                                if(has_post_thumbnail()){
                                    echo wp_trim_words(get_the_title(),5);
                                }else{
                                    echo get_the_title();
                                }
                                ?></a></h3>
                        <div class="text-muted">
                            <?php echo date("F j, Y", strtotime($post->post_date)); ?></div>
                        <div class="sub-featured-excerpt"><?php
                            if(has_post_thumbnail()){
                                echo wp_trim_words(get_the_excerpt(), 20);
                            }else{
                                echo wp_trim_words(get_the_excerpt(), 40);
                            }
                            ?></div>
                    </div>
                    <div class="sub-featured-continue">
                        <a href="<?php the_permalink();?>" class="stretched-link">Continue reading...</a>
                    </div>
                </div>
                <?php if ( has_post_thumbnail() ) { ?>
                        <div class="sub-featured-image">
                            <a href="<?php the_permalink();?>">
                                <?php the_post_thumbnail(); ?>
                            </a>
                        </div>
                     <?php } ?>
            </div>
        <?php endwhile; endif; ?>
    </div>



    </div>
<?php get_footer();?>
</body>
</html>
