<footer class="footer">Need more help? <a href="http://collaborate.iearn.org/help">Contact us</a>.</footer>

</div><!--.wrapper--><?php 

wp_footer();

if(! current_user_can('delete_others_posts')) {
	include_once 'analytics.php';
}

?></body>

</html>