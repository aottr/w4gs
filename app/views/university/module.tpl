<h2><?=$module['name']?> [<?=$module['abbr']?>]</h2>

<p>
<?=$module['description']?>
</p>

<?php 
	foreach($module['dates'] as $date) { ?>

	<?=$date['text']?> - <?=$date['datetime']?><br/>

<?php	} ?>

<?php 
	foreach($module['links'] as $link) { ?>

	<a href="<?=$link['url']?>"><?=$link['text']?></a><br/>

<?php	} ?>

<?php 
	foreach($module['books'] as $book) { ?>

	<?=$book['name']?><br/>

<?php	} ?>