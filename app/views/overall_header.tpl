<!DOCTYPE HTML>
<html>
    <head>
        <title>Test</title>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery-ui-1.10.4.min.js"></script>
        <link href="<?php echo BASE_URL; ?>css/forms.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo BASE_URL; ?>css/main.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo BASE_URL; ?>css/typographie.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo BASE_URL; ?>css/ui-lightness/jquery-ui-1.10.4.min.css" type="text/css" rel="stylesheet" />
	<?php
            if(isset($this->js)) {
                foreach ($this->js as $js) {
                    echo '<script type="text/javascript" src="' . BASE_URL . 'js/' . $js . '"></script>';
		}
            }
	?>
    </head>

    <body>
        <div id="wrapper">
            