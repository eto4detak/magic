  <?php 

  /*========================================================
      *   Список таксономии collection с дочерними 
      ========================================================*/
  $args = array(
          'taxonomy' => 'collection',
          'hide_empty' => false,
           );
        $terms = get_terms( $args );
  if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
      $count = count($terms);
      $term_list .= '<div id="jquery-accordion-menu" class="jquery-accordion-menu green">';
      $term_list .= '<ul id="demo-list">';
      foreach ($terms as $term) {
        if($term->parent === 0){
        $term_list .= '<li class=""><a href="' .  get_term_link( $term->term_id ) . '"> ' . $term->name . '</a>';
        $term_children = get_term_children( $term->term_id, 'collection' );
          if($term_children) {

              $term_list .= '<ul class="submenu">';
              foreach ($term_children as $item) {
                foreach ($terms as  $tt) {
                  if($tt->term_id === $item)
                   $term_list .= '<li class=""><a href="' .  get_term_link( $tt->term_id ) . '"> ' . $tt->name . '</a></li>';
                }
              }
              $term_list .= '</ul>';
            }
          $term_list .= '</li>';
        }
      }
   $term_list .= '</ul>';
   $term_list .= '</div>';
  }

  /*========================================================
    *  Шорткод [list_collection exclude="1,2"]
    ========================================================*/

class Collection_Walker_Category extends Walker_Category {
   function start_lvl( &$output, $depth = 0, $args = array() ) {
    if ( 'list' != $args['style'] )
      return;
    $indent = str_repeat("\t", $depth);
    $output .= "$indent<ul class='submenu'>\n";
  }
  public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
    /** This filter is documented in wp-includes/category-template.php */
    $cat_name = apply_filters(
      'list_cats',
      esc_attr( $category->name ),
      $category
    );

    // Don't generate an element if the category name is empty.
    if ( ! $cat_name ) {
      return;
    }

    $var = get_pagenum_link();
    $var2 = get_term_link( $category );
    if( $var2 !==  $var )
    {
      $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
    }
    else $link = '<a ';
    // $link = '<a href="' . esc_url( get_term_link( $category ) ) . '" ';
    if ( $args['use_desc_for_title'] && ! empty( $category->description ) ) {
      /**
       * Filters the category description for display.
       *
       * @since 1.2.0
       *
       * @param string $description Category description.
       * @param object $category    Category object.
       */
      $link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
    }

    // $link .= '>';
    $link .= '><i class="fa fa-file-image-o"></i>';
    $link .= $cat_name . '</a>';

    if ( ! empty( $args['feed_image'] ) || ! empty( $args['feed'] ) ) {
      $link .= ' ';

      if ( empty( $args['feed_image'] ) ) {
        $link .= '(';
      }

      $link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $args['feed_type'] ) ) . '"';

      if ( empty( $args['feed'] ) ) {
        $alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
      } else {
        $alt = ' alt="' . $args['feed'] . '"';
        $name = $args['feed'];
        $link .= empty( $args['title'] ) ? '' : $args['title'];
      }

      $link .= '>';

      if ( empty( $args['feed_image'] ) ) {
        $link .= $name;
      } else {
        $link .= "<img src='" . $args['feed_image'] . "'$alt" . ' />';
      }
      $link .= '</a>';

      if ( empty( $args['feed_image'] ) ) {
        $link .= ')';
      }
    }

    if ( ! empty( $args['show_count'] ) ) {
      $link .= ' (' . number_format_i18n( $category->count ) . ')';
    }
    if ( 'list' == $args['style'] ) {
      $output .= "\t<li";
      $css_classes = array(
        'cat-item',
        'cat-item-' . $category->term_id,
      );

      if ( ! empty( $args['current_category'] ) ) {
        // 'current_category' can be an array, so we use `get_terms()`.
        $_current_terms = get_terms( $category->taxonomy, array(
          'include' => $args['current_category'],
          'hide_empty' => false,
        ) );

        foreach ( $_current_terms as $_current_term ) {
          if ( $category->term_id == $_current_term->term_id ) {
            $css_classes[] = 'current-cat';
          } elseif ( $category->term_id == $_current_term->parent ) {
            $css_classes[] = 'current-cat-parent';
          }
          while ( $_current_term->parent ) {
            if ( $category->term_id == $_current_term->parent ) {
              $css_classes[] =  'current-cat-ancestor';
              break;
            }
            $_current_term = get_term( $_current_term->parent, $category->taxonomy );
          }
        }
      }

      /**
       * Filters the list of CSS classes to include with each category in the list.
       *
       * @since 4.2.0
       *
       * @see wp_list_categories()
       *
       * @param array  $css_classes An array of CSS classes to be applied to each list item.
       * @param object $category    Category data object.
       * @param int    $depth       Depth of page, used for padding.
       * @param array  $args        An array of wp_list_categories() arguments.
       */
      $css_classes = implode( ' ', apply_filters( 'category_css_class', $css_classes, $category, $depth, $args ) );

      $output .=  ' class="' . $css_classes . '"';
      $output .= ">$link\n";
    } elseif ( isset( $args['separator'] ) ) {
      $output .= "\t$link" . $args['separator'] . "\n";
    } else {
      $output .= "\t$link<br />\n";
    }
  }
}

    add_shortcode( 'list_collection', 'theme_shortcode_list_collection_' );
function theme_shortcode_list_collection_( $atts ){
  if(!empty($atts['exclude'] )){
    $mass = explode(",", $atts['exclude'] );
    foreach($mass as &$value) {
      $value  = ((int)$value) === 0 ?  -1 : ((int)$value);
    }
    $atts  = array('exclude' => implode(",", $mass) ); 
  }
    $atts = shortcode_atts( array(
    'exclude' => '',
  ), $atts );

  $args = array(
    'taxonomy' => 'collection',
    'hide_empty' => false,
  );

  $terms = get_terms( $args );
  $args = array(
    'taxonomy'          => 'collection', 
    'show_count'        => 0,      
    'pad_counts'        => 0,      
    'echo'               => 0,
    'title_li'           => '<div id="jquery-accordion-menu" class="jquery-accordion-menu green"><ul id="demo-list">',
    'exclude'            => '',
    'exclude_tree'       => $atts ? $atts['exclude'] : '',
    'current_category'   => 0,
    'walker'             => new Collection_Walker_Category(),
  );

  $list .=  wp_list_categories( $args );
  return $list;
}


// function theme_shortcode_list_collection_( $atts ){

//   $args = array(
//           'taxonomy' => 'collection',
//           'hide_empty' => false,
//            );
//         $terms = get_terms( $args );
//   if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
//       $count = count($terms);
//       $term_list .= '<div id="jquery-accordion-menu" class="jquery-accordion-menu green">';
//       $term_list .= '<ul id="demo-list">';
//       foreach ($terms as $term) {
//         if($term->parent === 0){
//         $term_list .= '<li class=""><a href="' .  get_term_link( $term->term_id ) . '"> ' . $term->name . '</a>';
//         $term_children = get_term_children( $term->term_id, 'collection' );
//           if($term_children) {

//               $term_list .= '<ul class="submenu">';
//               foreach ($term_children as $item) {
//                 foreach ($terms as  $tt) {
//                   if($tt->term_id === $item)
//                    $term_list .= '<li class=""><a href="' .  get_term_link( $tt->term_id ) . '"> ' . $tt->name . '</a></li>';
//                 }
//               }
//               $term_list .= '</ul>';
//             }
//           $term_list .= '</li>';
//         }
//       }
//    $term_list .= '</ul>';
//    $term_list .= '</div>';
//   }
//  return $term_list;
// }
