<ul>
<?php
for($i = 0; $i < count($this->events); $i++)
    echo '<li><a href="' . BASE_URL .'event/show/' . $this->events[$i]['id'] . '">' . $this->events[$i]['name'] . '</a></li>';
?>
</ul>