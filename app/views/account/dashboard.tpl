<div id="content-main">
    <h2>Willkommen, <?php echo $this->name; ?></h2>
    <div class="box-body">
        <h1>#<?php echo zerofill($this->id, 5); ?></h1>
        <div class="content">
            <ul class="wide">
                <li><a href="#">Veranstaltungen durchst&ouml;bern</a></li>
                <li><a href="#">Benutzerkonto ansehen</a></li>
                <li><a href="#">Benutzerkonto bearbeiten</a></li>
                <li><a href="<?php echo BASE_URL . 'account/logout'; ?>">Abmelden</a></li>
            </ul>
        </div>
        <h1>Bereits gebuchte Veranstaltungen</h1>
        <div class="content">
            <ul>
                        <?php
                            for($i = 0; $i < count($this->events); $i++)
                                echo '<li><a href="#' . $this->events[$i]['id'] . '">' . $this->events[$i]['name'] . '</a></li>';
                        ?>
            </ul>
        </div>
    </div>
</div>
<div id="footer">
                2014 by <a href="http://www.staubrein.org/">AERVOS</a>
</div>
<?php
function zerofill($mStretch, $iLength = 2)
{
    $sPrintfString = '%0' . (int)$iLength . 's';
    return sprintf($sPrintfString, $mStretch);
}
?>