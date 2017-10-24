<section class="fullwidth">
<h2><?=$module['name']?> [<?=$module['abbr']?>]</h2>

<p>
<?=$module['description']?>
</p>
<?php if(count($module['dates'])) { ?>
<h3>Termine</h3>
<ul>
<?php 
	foreach($module['dates'] as $date) { ?>

	<li><?=$date['text']?> - <?=$date['datetime']?></li>

<?php	} ?>
</ul>
<?php } /* close if */

if(count($module['links'])) { ?>
<h3>Links</h3>
<ul>
<?php 
	foreach($module['links'] as $link) { ?>

	<li><a href="<?=$link['url']?>"><?=$link['text']?></a></li>

<?php	} ?>
</ul>
<?php } /* close if */

if(count($module['books'])) { ?>
<h3>Referenzen</h3>
<ul>
<?php 
	foreach($module['books'] as $book) { ?>

	<li><?=$book['name']?></li>

<?php	} /* close foreach */ ?>
</ul>
<?php } /* close if */ ?>
<p>
	<a href="<?=BASE_URL?>university">Zur&uuml;ck</a>
</p>
</section>