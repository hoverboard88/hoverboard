<form class="search" role="search" action="<?php echo site_url(); ?>">
  <div class="search__field">
    <label for="s" class="screen-reader-text">
      Search
    </label>

    <input id="s" class="search__input" type="text" placeholder="<?php echo esc_html( $placeholder ); ?>" name="s">

  	<button class="search__submit btn" type="submit">
      Search
    </button>
  </div>
</form>
