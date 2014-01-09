<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mcc.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/mcc.js'); ?>
    <?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<div class="container" id="page">

	<div>
        <?php $this->widget('bootstrap.widgets.TbNavbar', array(
            'brandLabel' => 'MCC - MythTV Control Center',
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbNav',
                    'items' => array(
                        array('label' => Yii::t('app', 'Recordings'),'items' => array(
                            array('label' => Yii::t('app', 'Recorded'),'url' => array('/Recordings/index')),
                            array('label' => Yii::t('app', 'Upcoming'),'url' => array('/Recordings/upcoming')),
                        )),
                        array('label' => Yii::t('app', 'Guide'),'url' => array('/Guide/index')),
                        array('label' => Yii::t('app', 'Users'), 'items' => array(
                            array('label' => Yii::t('app', 'Users'), 'url' => array('/user/admin')),
                            array('label' => Yii::t('app', 'Assignments'), 'url' => array('/auth/assignment/index')),
                            array('label' => Yii::t('app', 'Roles'), 'url' => array('/auth/role/index')),
                            array('label' => Yii::t('app', 'Tasks'), 'url' => array('/auth/task/index')),
                            array('label' => Yii::t('app', 'Operations'), 'url' => array('/auth/operation/index')),
                        )),
				        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ),
                ),
            ),

            )); 
        ?>

	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
    
    <div id="content">
    	<?php echo $content; ?>
    </div>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Florian Bittner<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
