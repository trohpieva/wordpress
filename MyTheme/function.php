<?php

require get_template_directory() . '/inc/constants.php';

require get_template_directory() . '/inc/functions-custom-header.php';

require get_template_directory() . '/inc/functions-fonts.php';

require get_template_directory() . '/inc/functions-enqueue.php';

require get_template_directory() . '/inc/functions-menus.php';

require get_template_directory() . '/inc/functions-general.php';

require get_template_directory() . '/inc/functions-helpers.php';

require get_template_directory() . '/inc/functions-template-tags.php';

require get_template_directory() . '/inc/functions-widgets.php';

require get_template_directory() . '/inc/functions-css.php';

require get_template_directory() . '/inc/functions-tgmpa.php';

if( is_admin() ) {
    require get_template_directory() . '/admin/functions-admin.php';
}

if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/functions-jetpack.php';
}

if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/inc/functions-woocommerce.php';   
}

require get_template_directory() . '/inc/lib/trt-customize/companion-plugin/class-customize.php';

require get_template_directory() . '/inc/lib/trt-customize/documentation/class-customize.php';

function my_register_sidebars() {
/*Для отображения сайдбара в виджетах, когда он повляется там, смело переносим в колонку все, что хотим отобразить*/
/* регистрация правого сайдбара */
	register_sidebar(
		array(
			'id' => 'shop', // уникальный id для сайта, назначается правому сайдбару
			'name' => 'Shop', // название сайдбара, которое будет отображаться в админке
			'description' => 'Add widgets here.', // описание выводимое в админке для сайдбара
			'before_widget' => '<div class="r-sidebar">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>', // в этой и предыдущей строке мы задали контейнер в котором будет размещен сайдбар
			'before_title' => '<h3 class="r-wtitle">', // если оставить пустым, будет выводиться в <h2>
			'after_title' => '</h3>'
		)
	);
}
add_action( 'widgets_init', 'my_register_sidebars' );

if (function_exists('my_register_sidebars')){
	
	register_sidebar(array(
		     'id' => 'newright-sidebar', // уникальный id для сайта, назначается правому сайдбару
			'name' => 'Правый сайдбар', // название сайдбара, которое будет отображаться в админке
			'description' => 'Вставьте сюда ваши виджиты', // описание выводимое в админке для сайдбара
			'before_widget' => '<div id"%1$s" class="widget ale_widget %2$s">', // по умолчанию виджеты выводятся <li>-списком
			'after_widget' => '</div>', // в этой и предыдущей строке мы задали контейнер в котором будет размещен сайдбар
			'before_title' => '<h2 class="widget_header">', // если оставить пустым, будет выводиться в <h2>
			'after_title' => '</h2>'
	));
	

}

