<?php

add_action( 'wp_enqueue_scripts', 'enqueue_styles' );

function enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/css/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory().'css/style.css' );
    // for jQuery
	wp_enqueue_script('jquery_mini_cdn','https://code.jquery.com/jquery-3.6.0.min.js');
}


##########################
//	Tab Filters with Ajax
##########################

// hooks for filter ajax
add_action( 'wp_ajax_filter', 'filter_ajax' );
add_action( 'wp_ajax_nopriv_filter', 'filter_ajax' );

// callback for filter_ajax
function filter_ajax(){
	$cat_id = $_REQUEST['id'];
	$pg = $_REQUEST['pg'];
    $queryArr = array(
		'posts_per_page' => $_REQUEST['ppg'],
		'post_type' => 'product',
		'tax_query' => array(
		  array(
			'taxonomy' => 'product_cat',
            'field' => 'term_id',
            'terms' => $cat_id
			),
		  ),
		);
    if( $pg == 1 ) {
        $res = new wp_Query($queryArr);
        if ($res->found_posts < 1) {
            get_template_part( 'content', 'none' );
            hideLoadBtn();
            die();
        }
        while($res->have_posts()) { 
            $res->the_post(); 
            ?>
              <a class="flex-box flex-col" href="<?php the_permalink(); ?>" title="Watch This!">
                <div>
                  <p><?php the_title(); ?></p>
                </div>
              </a>
            <?php
        }
        haveMore($queryArr, $pg);
    } else {
        $queryArr['paged'] = $pg;
        $res = new wp_Query($queryArr);
        while($res->have_posts()) { 
            $res->the_post(); 
            ?>
              <a class="flex-box flex-col" href="<?php the_permalink(); ?>" title="Watch This!">
                <div>
                  <p><?php the_title(); ?></p>
                </div>
              </a>
            <?php
        }
        haveMore($queryArr, $pg);
    }
	die();
}

function hideLoadBtn(){
    ?>
    <script>
        jQuery('.load_more').hide();
    </script>
    <?php
}

function showLoadBtn(){
    ?>
    <script>
        jQuery('.load_more').show();
    </script>
    <?php
}

function haveMore($queryArr, $pg){
    $queryArr['posts_per_page'] = -1;
    $res = new wp_Query($queryArr);
    $noOfPost = $res->found_posts;
    $expg = ceil($noOfPost/$_REQUEST['ppg']);
    ($pg == $expg) ? hideLoadBtn() : showLoadBtn();
}