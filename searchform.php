<form action="<?php bloginfo('url'); ?>" method="get" id="search-form">
	<?php $search_term = $wp_query->query['s']; ?>
    <input type="text" name="s" placeholder="<?php echo is_search() ? $search_term : 'Search here'; ?>" />
    <div class="hint">Press Rtrn</div>
    <!-- <button type="submit" class="btn btn-default btn-sm">Search</button> -->
</form>
