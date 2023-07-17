 <!-- #content -->
 <aside id="secondary" class="sidebar-container" role="complementary">
     <div class="sidebar-inner">
         <div class="widget-area">
             <?php
                if (is_active_sidebar('primary-widget-area')) {
                    dynamic_sidebar('primary-widget-area'); 
                }
            ?>
         </div>
     </div>
 </aside>