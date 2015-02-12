<?php get_header(); ?>

<div class="search_results">

<h2>Search Results</h2>

<div class="search_results--search"><?php get_search_form(); ?></div>

<p>The following tutorials matched the term <strong><?php echo $_GET['s']; ?></strong>.</p>

<ul class="search_results--list" id="content">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<li>
	<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	<?php the_excerpt(); ?>
	<p><a href="<?php the_permalink(); ?>">View</a></a>
</li>

<?php endwhile; else: ?>
	
<li><h4>No tutorials could be found.</h4></li>

<?php endif; ?>

</ul>

</div>

<?php get_footer(); ?>