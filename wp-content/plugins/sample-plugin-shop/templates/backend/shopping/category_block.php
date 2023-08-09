<?php 
$args = array(
    'taxonomy'      => 'fvn-category',
    'hide_empty'    => false,
    'number'        => 8,
    'orderby'       => 'id',
    'order'         => 'DESC',
    'hierarchical'  => false
);
$the_category = get_terms($args);

?>
<div id="normal-sortables" class="meta-box-sortables ui-sortable">


    <div id="dashboard_right_now" class="postbox ">
        <div class="postbox-header">
            <h2 class="hndle ui-sortable-handle"><?= __('Category'); ?></h2>

        </div>
        <div class="inside">
            <div class="main">
                <ul>
                <?php 
                    $i = 1;
                    if (count($the_category) > 0) {
                        foreach ($the_category as $key => $cat) {
                            $link = 'term.php?taxonomy=fvn-category&tag_ID='.$cat->term_id.'&post_type=fvn-product&wp_http_referer=%2Fwordpress%2Fbai-1%2Fwp-admin%2Fedit-tags.php%3Ftaxonomy%3Dfvn-category%26post_type%3Dfvn-product';
                            echo '<li class="page-count"><a href="'.$link.'">'.$i.'. '.$cat->name.'</a></li>';
                            $i++;
                        }
                    }
                ?>
                   
                </ul>
                <p id="wp-version-message"><span id="wp-version">View All Fvn Category <a href="edit-tags.php?taxonomy=fvn-category&post_type=fvn-product">Click here</a>.</span></p>
            </div>
        </div>
    </div>
</div>