<?php get_header(); ?> 
  
  
  
  <!-- MAIN SECTION -->
    <section class="mainContent full-width clearfix coursesSection">
      <div class="container">
        <div class="row">
	
          <div class="col-md-9 col-sm-8 col-xs-12 pull-right">
            <div class="row">
			
			<?php
				while ( have_posts() ) {
					the_post();
						$post_thumbnail_id=get_post_thumbnail_id();
						$image_url_news = wp_get_attachment_image_src($post_thumbnail_id,'news-thumbnails-true');
					?>
						 
						 <div class="col-md-4 col-sm-6 col-xs-12 block item-color-js">
							<div class="thumbnail thumbnailContent">
							  <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url_news[0]?>" alt="<?php the_title();?>" class="img-responsive"></a>						
							  <div class="caption">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
								<ul class="list-inline">
								  <li><?php 
								  // echo nice_likes() 
								  ?></li>
								  <li><i class="fa fa-comments-o" aria-hidden="true"></i><?php comments_number('0 ком.', '1 ком.', '% ком.'); ?></li>
								  <li><i class="fa fa-eye" aria-hidden="true"></i> <?php if(function_exists('the_views')) { the_views(); } ?></li>
								</ul>
							  </div>
							</div>
						  </div>
						  
			<?php } ?>			
				
            </div>
			<div class="row">
				<div class="pagerArea text-center">

					<?php
					 // wp_pagenavi();
					  ?>

				</div>
			</div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-12 pull-left">
            <aside>
			  <div class="panel panel-default courseSidebar">
					<?php get_search_form(); ?>					
              </div>
              <div class="panel panel-default courseSidebar">
                <div class="panel-heading bg-color-2 border-color-2">
                  <h3 class="panel-title"><?php 
                  // the_field( 'category-text',option );
                   ?></h3>
                </div>
                <div class="panel-body">
                  <ul class="list-unstyled categoryItem">
    
					<?php
					// $cat_game_id=get_field('cat-game-id',option);
					// $categories = get_categories(array(
					// 	'type'         => 'post',
					// 	'child_of'     => $cat_game_id,
					// 	'orderby' => 'name',
					// 	'order' => 'ASC',
					// 	'hide_empty' => false
					// ));
					// foreach( $categories as $category ){
					// 	echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name.'</a></li>';
					// }
					?>	
	
                  </ul>
                </div>
              </div>
              <div class="rightSidebar">
                <div class="panel panel-default">
                  <div class="panel-heading bg-color-5 border-color-5">
                    <h3 class="panel-title"><?php the_field( 'popular-text',option); ?></h3>
                  </div>
                  <div class="panel-body">
                    <ul class="media-list blogListing">
						<?php
							
							$cat_game_id=get_field('cat-game-id',option);
							$args = array(
								'post_type'         => 'post',
								'post_status'       => 'publish',
								'posts_per_page' => 3,
								'orderby' => 'rand',
								'cat' => $cat_game_id
							);
							$query = new WP_Query( $args );
								 while ( $query->have_posts() ) {
									$query->the_post();
									
									$post_thumbnail_id=get_post_thumbnail_id();
									$image_url_mini = wp_get_attachment_image_src($post_thumbnail_id,'mini-thumbnails-true');
						?>	
							  <li class="media">
								<div class="media-left">
								  <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_url_mini[0]?>" alt="image"></a>
								</div>
								<div class="media-body">
								  <h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
								  <p style="margin:0"><i class="fa fa-comments-o" aria-hidden="true"></i> <?php comments_number('0 ком.', '1 ком.', '% ком.'); ?></p>
								  <p><i class="fa fa-eye" aria-hidden="true"></i> <?php if(function_exists('the_views')) { the_views(); } ?></p>
								</div>
							  </li>
						<?php } wp_reset_query(); ?>
                    </ul>
                  </div>
                </div>
              </div>
            </aside>
          </div>
        </div>

      </div>
    </section>
	

<?php get_footer();?>	