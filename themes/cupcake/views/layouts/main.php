<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo 'E-Comp' ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <!-- Reset -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/style/reset.css" /> 
    <!-- Main Style File -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/style/root.css" /> 
    <!-- Grid Styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/style/grid.css" /> 
    <!-- Typography Elements -->
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/style/typography.css" /> 
    <!-- Jquery UI -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/style/jquery-ui.css" />
    <!-- Jquery Plugin Css Files Base -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/style/jquery-plugin-base.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/assets/36de058a/detailview/styles.css">     

     <!--jquery base-->  
    
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
       <?php Yii::app()->clientScript->registerScript("miInfo",
              ' var j=jQuery(".info").animate({opacity:1.0}, 8000); j.slideUp("slow")',
              
              CClientScript::POS_READY);  ?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/jsValidaciones.js'); ?>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/toogle.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/fullcalendar.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.uniform.min.js"></script>
    
</head>
<body id='body'>
<div class="wrapper">

    <!-- START HEADER -->
    <div id="header">
    	<!-- logo -->
    	<div class="logo">	
            <a href="<?php echo Yii::app()->baseUrl; ?>/"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" width="112" height="35" alt="logo"/></a>	
        </div>
        
        <!-- notifications -->
        <div id="notifications"></br> <center><font color="#FFFFFF"><b> DOCUMENTOS ELECTRÓNICOS</b></font></center>
<!--        	<a href="index.html" class="qbutton-left"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/header/dashboard.png" width="16" height="15" alt="dashboard" /></a>
        	<a href="#" class="qbutton-normal tips"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/header/message.png" width="19" height="13" alt="message" /> <span class="qballon">23</span> </a>
        	<a href="#" class="qbutton-right"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/header/support.png" width="19" height="13" alt="support" /> <span class="qballon">8</span> </a>-->
                <div class="clear"></div>
        </div>
        
        <!-- quick menu -->
<!--        <div id="quickmenu">
        	<a href="#" class="qbutton-left tips" title="Add a new post"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/header/newpost.png" width="18" height="14" alt="new post" /></a>
        	<a id="open-stats" href="#" class="qbutton-right tips" title="Statistics"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/header/graph.png" width="17" height="15" alt="graph" /></a>
                <div class="clear"></div>
        </div>-->
        
        
        <!-- profile box -->
        <div id="profilebox">
        	<a href="#" class="display">
            	<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/user.png" width="33" height="33" alt="profile"/>	<b>Logeado como</b>	<span><?php echo Yii::app()->user->getState("name"); ?></span>
               </a>
            
        <div class="profilemenu">
            	<ul>
                	<li><a href="<?php echo Yii::app()->baseUrl; ?>/site/logout">Salir</a></li>
                </ul>
            </div>
            
        </div>
        
        
        <div class="clear"></div>
    </div>
    <!-- END HEADER -->
    
    <!-- START MAIN -->
    <div id="main">


        <?php echo Yii::app()->session['admin'] ;
        if(isset(Yii::app()->session['adminUser']))
        ?>
        <!-- START SIDEBAR -->
        <div id="sidebar">
        	
            <!-- start searchbox -->
            <div id="searchbox">
            	<div class="in">
               	  <form id="form1" name="form1" method="post" action="">
                  	<input name="textfield" type="text" class="input" id="textfield" onfocus="$(this).attr('class','input-hover')" onblur="$(this).attr('class','input')"  />
               	  </form>
            	</div>
            </div>
            <!-- end searchbox -->


  
            <!-- start sidemenu -->
            <div id="sidemenu">
                
            	<ul>
            	<?php 
                $auth=Yii::app()->authmanager;
                if ($auth->checkAccess("Administrador",Yii::app()->user->id )){ ?>
                    <li id="usuarios"><a href="<?php echo Yii::app()->baseUrl; ?>/usuarios/admin" ><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/sidemenu/user.png" width="16" height="16" alt="icon"/>Administrar Usuarios</a></li>
                    <li id="docAdmin"><a href="<?php echo Yii::app()->baseUrl; ?>/documentos/admin"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/sidemenu/copy.png" width="16" height="16" alt="icon"/>Subir Documentos</a></li>
                <?php }?>
                <?php 
                
                if ($auth->checkAccess("Invitado",Yii::app()->user->id )){ ?>
                    <li id="document"><a href="<?php echo Yii::app()->baseUrl; ?>/documentos/index"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/sidemenu/copy.png" width="16" height="16" alt="icon"/>Doc. Electronicos</a></li>
                     <li><a href="<?php echo Yii::app()->baseUrl; ?>/usuarios/reset"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/sidemenu/lock.png" width="16" height="16" alt="icon"/>Resetear Contraseña</a></li>
                 <?php }?>   
                </ul>
            </div>
            <!-- end sidemenu -->
        </div>
        <!-- END SIDEBAR -->
        <!-- START PAGE -->
        <div id="page">
                	<!-- START CONTENT -->
                    <div  id='contenido' class="content">
                        <?php echo $content; ?>
                   
                    </div>
                    <!-- END CONTENT -->
        </div>
        <!-- END PAGE -->
    <div class="clear"></div>
    </div>
    <!-- END MAIN -->
    <!-- START FOOTER -->
    <div id="footer">
    	<div class="left-column">© Copyright 2014 - All rights reserved.</div>
        <div class="right-column">Notario 35 Quito<br />
                     Gaspar de Villarroel y Amazonas, Quito, Ecuador.  
                    <br>
                    <a href="mailto:info@notario35quito.com">Contacto</a>
                    |
                    <a href="http://www.notario35quito.com/">Sitio WEB</a></div>
    </div>
    <!-- END FOOTER -->

</div>
          
    
</body>
</html>
