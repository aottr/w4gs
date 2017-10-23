<h2>Aktuelle Module</h2>
<ul>
<?php
	foreach($modules as $module) { ?>
	<li><a href="/_pg11/university/module/<?=$module['abbr']?>"><?=$module['name']?></a></li>
<?php } ?>
</ul>