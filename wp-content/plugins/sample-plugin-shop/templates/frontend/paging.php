<?php 
global $wpQuery, $fvnController;

$paging = $fvnController->getHelper('Paging');
?>
<div class="nav-article">
	<?php if ($wpQuery->max_num_pages > 1): ?>
	<span class="site-pagination-heading">Pages</span>
	<?php echo $paging->getPaging($wpQuery);?>	
	<?php endif; ?>

</div>