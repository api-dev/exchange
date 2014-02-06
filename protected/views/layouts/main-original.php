<!DOCTYPE html>
<html>
    <head>
        <meta name="format-detection" content="telephone=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta content="all" name="robots">
        <meta content="dynamic" name="document-state">
        <meta content="2 days" name="revisit-after">
        <meta content="Global" name="distribution">
        <meta http-equiv="pragma" content="no-cache">
        <meta name="description" content="<?php echo Yii::app()->params['meta_description']; ?>">
        <title><?php echo Yii::app()->params['meta_title']; ?></title>

        <!--[if lt IE 8]>
            <link rel="stylesheet" type="text/css" href="/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="/css/front/frontend.css" />

        <?php
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile('/js/front/Timer.js');
			Yii::app()->clientScript->registerScriptFile('/js/front/rateList.js');
        ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="w-left">
                <div class="logo">
                    <a href="/">
                        <img src="/images/logo.png" title="ЛБР-Агромаркет" alt="Логотип ЛБР-Агромаркет"/>
                    </a>
                </div>
                <?php $this->widget('ext.userMenu.UserMenu'); ?>
                <div class="footer">
                    <div>
                    <?php //$this->widget('notification.extensions.webNotifications.WebNotifications', array('url'=>$this->createUrl('/nfy/default/poll'))); ?>
                    </div>
                    <p>2014 &copy; ООО "ЛБР-Агромаркет"</p>
                </div>
            </div>
            <div class="w-right">
                <?php echo $content; ?>
            </div>
        </div>
    </body>
</html>