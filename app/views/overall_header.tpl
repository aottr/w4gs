<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo isset($doctitle) ? $doctitle : "&aelig;rvos.net"; ?></title>
        <link href="<?=BASE_URL?>css/wElements.css" type="text/css" rel="stylesheet" />
        <link href="<?=BASE_URL?>css/clean.css" type="text/css" rel="stylesheet" />
        <link href="<?=BASE_URL?>css/wagicon.css" type="text/css" rel="stylesheet" />
         <link href="<?=BASE_URL?>css/mediaquery.css" type="text/css" rel="stylesheet" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0;" /> 
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <script src="<?=BASE_URL?>/js/jquery-1.9.1.min.js"></script>
    </head>
    <body> 
        <div id="frame">
            <div id="logo">
                &aelig;rvos.net<span class="blink_me">_</span>
            </div>
            <div id="wrapper">
                <nav>

                    <a href="<?=BASE_URL?>page/gear" title="Meine Ausr&uuml;strung">Meine Ausr&uuml;stung</a>
                    
                    <?php if(Session::get('uid') != NULL) { ?>
                    
                    <a href="<?=BASE_URL?>user/dashboard" title="Dashboard"><span class="icon-uniC7 ndashboard"></span></a>
                    <a href="<?=BASE_URL?>user/show/<?=Session::get('uid')?>" title="Mein Profil"><span class="icon-uniDC nprofile"></span></a>
                    <a href="<?=BASE_URL?>user/dashboard" title="Freunde"><span class="icon-uniDD nfriends"></span></a>
                    
                    <?php	if(isset($newmessages)) { if($newmessages) { ?>
                    
                    <a href="<?=BASE_URL?>message" title="<?=$newmessages?> neue Nachichten"><span class="icon-uniC9 nmessages"></span><span class="small"><?=$newmessages?></span></a>
                    
                    <?php } else { ?>
                    
                    <a href="<?=BASE_URL?>message" title="Keine neuen Nachichten"><span class="icon-uniD1 nmessages"></span></a>
                    
                    <?php } } ?>
                    
                    <a href="<?=BASE_URL?>user/settings" title="Einstellungen"><span class="icon-uni57 nsettings"></span></a>
                    
                    <?php if(Session::get('plvl') <= MODERATOR_LEVEL) { ?>
                    	<a href="<?=BASE_URL?>admin" title="Verwaltungsterminal"><span class="icon-uni45"></span></a>
                    <?php } ?>
                    
                    <a href="<?=BASE_URL?>user/logout" title="Abmelden"><span class="icon-uniE8 nlogout"></span></a>	
                    	
                    <?php } else { ?>
                    
                    <a href="<?=BASE_URL?>user/login" title="Anmelden"><span class="icon-uniEA nlogin"></span></a>
                    
                    <?php } ?>
                </nav>
            
                <main>