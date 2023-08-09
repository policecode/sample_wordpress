<?php
$args = array(
    'post_type'     => 'fvn-product',
    'post_per_page' => 8,
    'orderby'       => 'date',
    'order'         => 'DESC'
);
$the_query = new WP_Query($args);
?>
<div id="normal-sortables" class="meta-box-sortables ui-sortable">

    <div id="dashboard_right_now" class="postbox ">
        <div class="postbox-header">
            <h2 class="hndle ui-sortable-handle"><?= __('Latest Products')?></h2>
        </div>

          <div class="inside">
              <div class="main">
                  <ul>
                    <?php 
                        $i = 1;
                        if ($the_query->have_posts()) {
                            while ($the_query->have_posts()) {
                                $the_query->the_post();
                                $link = 'post.php?post_type=fvn-product&post='.get_the_ID().'&action=edit';
                                echo '<li class="page-count"><a href="'.$link.'">'.$i.'. '.get_the_title().'</a></li>';
                                $i++;
                            }
                            wp_reset_postdata();
                        }
                    ?>
                  </ul>
                  <p id="wp-version-message"><span id="wp-version">View All Products <a href="edit.php?post_type=fvn-product">Click here</a>.</span></p>
              </div>
          </div>
      </div>
  </div>