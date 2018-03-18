<?php 
/*========================================================
  *  Добавлено : Поиск по товарам шинам
========================================================*/
add_action( 'solus_get_search_form', 'solus_product_search_form' );
function solus_product_search_form() {

$taxonomies = get_taxonomies();
// if(in_array('pa_color', $taxonomies)){
//   $args = array('taxonomy' => 'pa_color',);
//   $terms = get_terms( $args );
// }

// if(in_array('pa_size', $taxonomies)){
// $args_size = array('taxonomy' => 'pa_size',);
// $terms_size = get_terms( $args_size );
// }

// if(in_array('pa_marka', $taxonomies)){
// $args_marka = array('taxonomy' => 'pa_marka',);
// $terms_marka = get_terms( $args_marka );
// }

if(in_array('pa_brend', $taxonomies)){
$args_brend = array('taxonomy' => 'pa_brend',);
$terms_brend = get_terms( $args_brend );
}

if(in_array('pa_diametr', $taxonomies)){
$args_diametr = array('taxonomy' => 'pa_diametr',);
$terms_diametr = get_terms( $args_diametr );
}

if(in_array('pa_profil', $taxonomies)){
$args_profil = array('taxonomy' => 'pa_profil',);
$terms_profil = get_terms( $args_profil );
}

if(in_array('pa_sezonnost', $taxonomies)){
$args_sezonnost = array('taxonomy' => 'pa_sezonnost',);
$terms_sezonnost = get_terms( $args_sezonnost );
}

if(in_array('pa_shirina', $taxonomies)){
$args_shirina = array('taxonomy' => 'pa_shirina',);
$terms_shirina = get_terms( $args_shirina );
}
/*
$select_type = '<select name="city" >';
$select_type .= '<option value="" selected="selected">' . __( 'Select room type', 'smashing_plugin' ) . '</option>';
$select_type .= '<option value="entire">' . __( 'Entire house', 'smashing_plugin' ) . '</option>';
$select_type .= '<option value="private">' . __( 'Private room', 'smashing_plugin' ) . '</option>';
$select_type .= '<option value="shared">' . __( 'Shared room', 'smashing_plugin' ) . '</option>';
$select_type .= '</select>' . "\n";

$select_color = '<select name="color" >';
$select_color .= '<option value="" selected="selected">' . __( 'Любой', 'smashing_plugin' ) . '</option>';
foreach ($terms as $term ) {
 $select_color .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
}
$select_color .= '</select>' . "\n";


$select_size = '<div class="row">';
$select_size .= '<label>Размер</label>';
$select_size .= '<select name="size" >';
$select_size .= '<option value="" selected="selected">' . __( 'Любой', 'smashing_plugin' ) . '</option>';
if( $terms_size !== NULL)foreach ($terms_size as $term ) {
 $select_size .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
}
$select_size .= '</select>' . "\n";
$select_size .= '</div>';

$select_marka = '<div class="row">';
$select_marka .= '<label>Марка</label>';
$select_marka .= '<select name="marka" >';
$select_marka .= '<option value="" selected="selected">' . __( 'Любой', 'smashing_plugin' ) . '</option>';
if( $terms_marka !== NULL)foreach ($terms_marka as $term ) {$select_marka .= '<option value="' . $term->slug . '">' . $term->name . '</option>';}
$select_marka .= '</select>' . "\n";
$select_marka .= '</div>';*/

$select_brend = '<div class="row">';
$select_brend .= '<label>Производитель</label>';
$select_brend .= '<select name="brend" >';
$select_brend .= '<option value="" selected="selected">' . __( 'Любой', 'smashing_plugin' ) . '</option>';
if(!empty($terms_brend)  ){foreach ($terms_brend as $term ) {$select_brend .= '<option value="' . $term->slug . '">' . $term->name . '</option>';}}
$select_brend .= '</select>' . "\n";
$select_brend .= '</div>';

$select_diametr = '<div class="row">';
$select_diametr .= '<label>Посадочный диаметр</label>';
$select_diametr .= '<select name="diametr" >';
$select_diametr .= '<option value="" selected="selected">' . __( 'Любой', 'smashing_plugin' ) . '</option>';
if( !empty($terms_diametr) )foreach ($terms_diametr as $term ) {$select_diametr .= '<option value="' . $term->slug . '">' . $term->name . '</option>';}
$select_diametr .= '</select>' . "\n";
$select_diametr .= '</div>';

$select_profil = '<div class="row">';
$select_profil .= '<label>Профиль</label>';
$select_profil .= '<select name="profil" >';
$select_profil .= '<option value="" selected="selected">' . __( 'Любой', 'smashing_plugin' ) . '</option>';
if(!empty($terms_profil))foreach ($terms_profil as $term ) {$select_profil .= '<option value="' . $term->slug . '">' . $term->name . '</option>';}
$select_profil .= '</select>' . "\n";
$select_profil .= '</div>';

$select_sezonnost = '<div class="row">';
$select_sezonnost .= '<label>Сезонность</label>';
$select_sezonnost .= '<select name="sezonnost" >';
$select_sezonnost .= '<option value="" selected="selected">' . __( 'Любой', 'smashing_plugin' ) . '</option>';
if(!empty($terms_sezonnost) )foreach ($terms_sezonnost as $term ) {$select_sezonnost .= '<option value="' . $term->slug . '">' . $term->name . '</option>';}
$select_sezonnost .= '</select>' . "\n";
$select_sezonnost .= '</div>';

$select_shirina = '<div class="row">';
$select_shirina .= '<label>Сезонность</label>';
$select_shirina .= '<select name="shirina" >';
$select_shirina .= '<option value="" selected="selected">' . __( 'Любой', 'smashing_plugin' ) . '</option>';
if(!empty($terms_shirina) )foreach ($terms_shirina as $term ) {$select_shirina .= '<option value="' . $term->slug . '">' . $term->name . '</option>';}
$select_shirina .= '</select>' . "\n";
$select_shirina .= '</div>';

   $form = '
  <div class="aj_search" class="">
    <div class="row"><label class="title_label">Подбор шин</label></div>
    <form role="search" class="searchform tax_shini" action=' . get_bloginfo("url") . ' method="GET">
      <input type="hidden" value="product" name="post_type" />
      <input type="hidden" name="s" id="s"  autocomplete="on" />
      ' . $select_brend .'
      ' . $select_diametr .'
      ' . $select_profil .'
      ' . $select_sezonnost .'
      ' . $select_shirina .'
        <button type="submit" class="form_button">Подобрать шины</button>
    </form>
</div>
  ';
  echo $form;
}

function solus_change_search_tax( $query ) {

  $tax_query_add = array();
  if ( ! is_admin() && $query->is_search && ($query->query_vars['post_type'] === 'product' )) {
/*    if( !empty( get_query_var( 'color' ) ) ){
      $tax_query_add[] = array('taxonomy' => 'pa_color', 'field'    => 'slug', 'terms'    => get_query_var( 'color' ));
    }
    if( !empty( get_query_var( 'size' ) ) ){
      $tax_query_add[] = array('taxonomy' => 'pa_size', 'field'    => 'slug', 'terms'    => get_query_var( 'size' ));
    }
    if( !empty( get_query_var( 'marka' ) ) ){
      $tax_query_add[] = array('taxonomy' => 'pa_marka', 'field'    => 'slug', 'terms'    => get_query_var( 'marka' ));
    }*/
    $tax_query_add[] = array('taxonomy' => 'product_cat', 'field'    => 'slug', 'terms'    =>  array('vsesezon', 'zimnyaya-rezina', 'letnyaya-rezina') );
    if( !empty( get_query_var( 'brend' ) ) ){
      $tax_query_add[] = array('taxonomy' => 'pa_brend', 'field'    => 'slug', 'terms'    => get_query_var( 'brend' ));
    }
    if( !empty( get_query_var( 'diametr' ) ) ){
      $tax_query_add[] = array('taxonomy' => 'pa_diametr', 'field'    => 'slug', 'terms'    => get_query_var( 'diametr' ));
    }
    if( !empty( get_query_var( 'profil' ) ) ){
      $tax_query_add[] = array('taxonomy' => 'pa_profil', 'field'    => 'slug', 'terms'    => get_query_var( 'profil' ));
    }    
    if( !empty( get_query_var( 'sezonnost' ) ) ){
      $tax_query_add[] = array('taxonomy' => 'pa_sezonnost', 'field'    => 'slug', 'terms'    => get_query_var( 'sezonnost' ));
    }
    if( !empty( get_query_var( 'shirina' ) ) ){
      $tax_query_add[] = array('taxonomy' => 'pa_shirina', 'field'    => 'slug', 'terms'    => get_query_var( 'shirina' ));
    }

    $args2 = array('tax_query' => array('relation' => 'AND', $tax_query_add ));
    $query->set( 'tax_query', $args2 );
    $query->parse_query_vars();

  }
}
add_action( 'pre_get_posts', 'solus_change_search_tax' );

function solus_registerquery_vars( $vars ) {
  $vars[] = 'color';
  $vars[] = 'size';
  $vars[] = 'marka';

  $vars[] = 'brend';
  $vars[] = 'diametr';
  $vars[] = 'profil';
  $vars[] = 'sezonnost';
  $vars[] = 'shirina';
  return $vars;
}
add_filter( 'query_vars', 'solus_registerquery_vars' );
/*========================================================
  * end Поиск по товарам шинам
========================================================*/