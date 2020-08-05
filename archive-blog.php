<?php get_header(); ?>

<div class="container background-white margin-top-5">
    <?php
        global $post;
        $featured_post = get_posts(array(
          'post_type' => 'blog',
          'meta_key' => 'is_featured_blog_post',
          'meta_value' => '1'
        ));
        
        if ($featured_post) {
            setup_postdata($featured_post[0]); ?>
            <div class="jumbotron overlay-darker">
                <a href="<?php the_permalink(); ?>">
                    <h1 class="featured-title"><?php the_title(); ?></h1>
                    <p class="featured-abstract"><?php the_excerpt(); ?></p>
                    <p class="featured-abstract"><a href="<?php the_permalink(); ?>">Continue Reading...</a></p>
                </a>
            </div>
            
            <?php
            wp_reset_postdata();
        } ?>
    
    
    
    
    
    <div class="sub-featured-container">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="thumbnail sub-featured-post">
                <div class="padding-sub-featured">
                    <div class="blog-post-summary">
                        <!--                        <strong class="d-inline-block mb-2 text-primary">Category</strong>-->
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
                        <a href="<?php the_permalink();?>" >Continue reading...</a>
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
