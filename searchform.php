<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>" role="search">
	<label for="s" class="assistive-text">Buscar</label>
	<input type="text" class="field" name="s" value="<?php echo esc_attr(get_search_query()); ?>" id="s" placeholder="Buscar &hellip;" />
	<button type="submit" class="submit" id="searchsubmit">Buscar</button>
</form>
