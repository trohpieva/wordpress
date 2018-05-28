<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*is_active_sidebar роверяет, есть ли в сайдбаре виджиты*/
 /*dynamic_sidebar выводит сайдбар*/
<?php if ( is_active_sidebar( 'shop' ) ) : ?>
 
	<div id="shop" class="sidebar">

		<?php dynamic_sidebar( 'shop' ); ?>
 
	</div>
 
<?php endif; ?>