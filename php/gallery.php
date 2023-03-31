<?php
    function show_gallery($board_features) {
      $posts = $board_features->get_posts();
      foreach ($posts as $post) {
        $filepath = $post->get_filepath();
        $msg = $post->get_msg();
echo <<<END
      <div class="post">
          <figure class="post-img">
            <img src="$filepath">
          </figure>
          <span class="post-overlay">
            <p class="post-msg">$msg</p>  
          </span>
      </div>
END;
      }
    }
?>
