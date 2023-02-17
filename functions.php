<?php 
//функция для отображения картинок svg
function add_file_types_to_uploads($file_types){
  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes );
  return $file_types;
  }
  add_action('upload_mimes', 'add_file_types_to_uploads');

//Совместимость woocommerce с нашей темой
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

// Отключение стилей WooCommerce по умолчанию
add_filter("woocommerce_enqueue_styles", "__return_empty_array");

//Подключаем стили главной страницы
add_filter( 'wp_enqueue_style', 'main_style', 25 );
function main_style() {
    wp_enqueue_style( 'style-main_style', get_stylesheet_directory_uri(). '/style.css' );
}

//Подключаем скрипт
add_action('wp_footer', 'my_scripts_method');
function my_scripts_method()
{
    wp_enqueue_script('main-script-jq', get_stylesheet_directory_uri(). '/jq.js');
    wp_enqueue_script('main-script-product', get_stylesheet_directory_uri(). '/product.js');
    wp_enqueue_script('main-script-burger', get_stylesheet_directory_uri(). '/burger.js');
    wp_enqueue_script('main-script-popup', get_stylesheet_directory_uri(). '/product_popup.js');
    wp_enqueue_script('main-script-ckeckout', get_stylesheet_directory_uri(). '/ckeckout.js');
}

//Убрать кол-во товаров в категории
add_filter('woocommerce_subcategory_count_html','mytheme_remove_count');
function mytheme_remove_count(){
	return;
}

//меняем кнопку добавления в корзину на странице категории
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_add_to_cart_button_text_archives' );  
function woocommerce_add_to_cart_button_text_archives() {
  return ;
}
//меняем кнопку добавления в корзину на странице товара
add_filter( 'woocommerce_product_single_add_to_cart_text', 'bbloomer_add_symbol_add_cart_button_single' );
 function bbloomer_add_symbol_add_cart_button_single() {
   $button_new = 'В корзину';
  //return $button_new;
  echo '<div class="add_to_card">';
  echo $button_new;
  echo '</div>';
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',40);  


//Переносим кнопку  корзины вниз 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',65);


//Убираем Детали в карточке товара
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs',10);


//добавляем стрелки к слайдеру в карточке товара
add_filter( 'woocommerce_single_product_carousel_options', 'truemisha_product_gallery_arrows' );
 
function truemisha_product_gallery_arrows( $options ) {
	$options[ 'directionNav' ] = true;
  $options[ 'prevText' ] = '';
  $options[ 'nextText' ] = '';
	return $options;
}


