<?php

class AdminModule extends CWebModule
{
    public function init()
    {
        $this->setImport(array(
            'notification.models.*',
            'notification.components.*',
        ));
    }

    /*public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            
            //$controller->layout = 'main';
            Yii::app()->clientScript->registerCssFile('/css/back/backend.css');
            Yii::app()->clientScript->registerCssFile('/css/ui/jquery-ui-1.10.3.css');
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile('/js/ui/jquery-ui-1.10.3.js');
            Yii::app()->clientScript->registerScriptFile('/js/ui/timepicker.js'); 
            Yii::app()->clientScript->registerScriptFile('/js/back/AjaxContentLoader.js');
            Yii::app()->clientScript->registerScriptFile('/js/back/EditTransport.js');

            if(Yii::app()->user->isGuest){
                Yii::app()->user->returnUrl = Yii::app()->request->requestUri;
                Yii::app()->request->redirect('/user/login/');
            }
            elseif(Yii::app()->user->checkAccess('admin'))
                    return true;
            else {
                throw new CHttpException(403,Yii::t('yii','У Вас недостаточно прав доступа.'));
            }
            // this method is called before any module controller action is performed
            // you may place customized code here
            
            return true;
        } else
            return false;
    }*/
}