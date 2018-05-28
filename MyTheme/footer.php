<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buildr
 */
/*Получаем код для статистики на LiveInternet и вставляем в наш код*/
?>

	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">
			
		 <div class="wrapp">
					<!--LiveInternet counter--><script type="text/javascript">
document.write("<a href='//www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t11.1;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров за 24"+
" часа, посетителей за 24 часа и за сегодня' "+
"border='0' width='88' height='31'><\/a>")
</script><!--/LiveInternet-->
					 </div>
			<div class="wrap">
				 <div aligh = "center">
					 
					 <div id="site-info">&copy 2018 — <?php echo date('Y') ?>
                <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
</a> <br> Все права защищены. Разработчики сайта Трохпиева Ю., Васильева И., Журавлева А., Вилаева А.
					
				</div>
					
					</div>	
				
				
			</div><!-- .wrap -->
		
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
