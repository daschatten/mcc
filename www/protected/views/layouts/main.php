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
            'brandLabel' => '<span id="app-name">MythTV Control Center</span>',
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbNav',
                    'items' => array(

                        array(
                            'label' => Yii::t('app', 'Recordings'),
                            'items' => array(
                                array(
                                    'label' => Yii::t('app', 'Recorded'),
                                    'url' => array('/Recordings/index'), 
                                    'visible' => Yii::app()->user->checkAccess('o_recorded_view')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Upcoming'),
                                    'url' => array('/Recordings/upcoming'), 
                                    'visible' => Yii::app()->user->checkAccess('o_upcoming_view')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Archive'),
                                    'url' => array('/Recordings/archive'), 
                                    'visible' => Yii::app()->user->checkAccess('o_archive_use')
                                )),
                            'visible' => (Yii::app()->user->checkAccess('o_recorded_view') or Yii::app()->user->checkAccess('o_upcoming_view') or Yii::app()->user->checkAccess('o_archive_use'))
                            ),

                        array(
                            'label' => Yii::t('app', 'Status'),
                            'items' => array(
                                array(
                                    'label' => Yii::t('app', 'Backend'),
                                    'url' => array('/status/backend'), 
                                    'visible' => Yii::app()->user->checkAccess('o_status_backend_view')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Tuner'),
                                    'url' => array('/status/tuner'), 
                                    'visible' => Yii::app()->user->checkAccess('o_upcoming_view')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Storage'),
                                    'url' => array('/status/storage'), 
                                    'visible' => Yii::app()->user->checkAccess('o_status_storage_view')
                                )),
                            'visible' => Yii::app()->user->checkAccess('o_status_backend_view') or Yii::app()->user->checkAccess('o_upcoming_view') or Yii::app()->user->checkAccess('o_status_storage_view')
                        ),

                        array(
                            'label' => Yii::t('app', 'Guide'), 
                            'url' => array('/Guide/view'), 
                            'visible' => Yii::app()->user->checkAccess('o_guide_view')
                        ),

                        array(
                            'label' => Yii::t('app', 'Admin'), 
                            'items' => array(
                                array(
                                    'label' => Yii::t('app', 'Settings'), 
                                    'url' => array('/config/check'), 
                                    'visible' => Yii::app()->user->checkAccess('o_manage_settings')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Users'), 
                                    'url' => array('/user/admin'), 
                                    'visible' => Yii::app()->user->checkAccess('o_manage_users')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Assignments'), 
                                    'url' => array('/auth/assignment/index'), 
                                    'visible' => Yii::app()->user->checkAccess('o_manage_assignments')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Roles'), 
                                    'url' => array('/auth/role/index'), 
                                    'visible' => Yii::app()->user->checkAccess('o_manage_roles')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Tasks'), 
                                    'url' => array('/auth/task/index'), 
                                    'visible' => Yii::app()->user->checkAccess('o_manage_tasks')
                                ),
                                array(
                                    'label' => Yii::t('app', 'Operations'), 
                                    'url' => array('/auth/operation/index'), 
                                    'visible' => Yii::app()->user->checkAccess('o_manage_operations')
                                )),
                            'visible' => Yii::app()->user->checkAccess('o_manage_settings') or Yii::app()->user->checkAccess('o_manage_users') or Yii::app()->user->checkAccess('o_manage_assignments') or Yii::app()->user->checkAccess('o_manage_roles') or Yii::app()->user->checkAccess('o_manage_tasks') or Yii::app()->user->checkAccess('o_manage_operations')
                        ),

				        array(
                            'label' => Yii::t('app', 'Login'), 
                            'url' => array('/site/login'), 
                            'visible' => Yii::app()->user->isGuest
                        ),

				        array(
                            'label' => Yii::t('app', 'Logout').' ('.Yii::app()->user->name.')', 
                            'url' => array('/site/logout'), 
                            'visible'=>!Yii::app()->user->isGuest
                        ),
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
