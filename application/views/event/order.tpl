<ul>
<?php
for($i = 0; $i < count($this->orders); $i++)
    echo '<li><a href="select/' . $this->orders[$i]['id'] . '">' . $this->orders[$i]['name'] . 
        '</a><br><span>' . $this->orders[$i]['description'] . '</span> <br><span>' . $this->orders[$i]['fee'] . 'EURO</span></li>';
?>
</ul>