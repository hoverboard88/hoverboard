<form class="search" role="search" action="<?php echo site_url(); ?>">
  <div class="search__field">
    <label for="s" class="screen-reader-text">
      Search
    </label>

    <input id="s" class="search__input" type="text" value="<?php echo get_search_query(); ?>" placeholder="<?php echo 'Search ' . get_bloginfo( 'name') . '…'; ?>" name="s">

  	<button class="search__submit btn" type="submit">
      Search
    </button>
  </div>
</form>
