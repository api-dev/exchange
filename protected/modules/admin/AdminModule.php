<?php

class AdminModule extends CWebModule
{
    public function init()
    {
            // this method is called when the module is being created
            // you may place code here to customize the module or the application

            // import the module-level models and components
            $this->setImport(array(
                    'admin.models.*',
                    'admin.components.*',
            ));
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            $controller->layout = 'main';
            Yii::app()->clientScript->registerCssFile('/css/back/backend.css?'.time());
            Yii::app()->clientScript->registerCssFile('/css/ui/jquery-ui-1.10.3.css');
            Yii::app()->clientScript->registerCssFile('/css/back/alertify/core.css');
            Yii::app()->clientScript->registerCssFile('/css/back/alertify/default.css');
            Yii::app()->clientScript->registerCoreScript('jquery');
            Yii::app()->clientScript->registerScriptFile('/js/ui/jquery-ui-1.10.3.js');
            Yii::app()->clientScript->registerScriptFile('/js/jquery.redirect.js');
            Yii::app()->clientScript->registerScriptFile('/js/ui/timepicker.js'); 
            Yii::app()->clientScript->registerScriptFile('/js/back/AjaxContentLoader.js');
            Yii::app()->clientScript->registerScriptFile('/js/back/EditTransport.js');
            Yii::app()->clientScript->registerScriptFile('/js/back/editStatus.js');
            Yii::app()->clientScript->registerScriptFile('/js/back/search.js');
            Yii::app()->clientScript->registerScriptFile('/js/back/backend.js');
            Yii::app()->clientScript->registerScriptFile('/js/back/alertify.js');

            if(Yii::app()->user->isGuest){
                Yii::app()->user->returnUrl = Yii::app()->request->requestUri;
                Yii::app()->request->redirect('/user/login/');
            }
//            elseif(Yii::app()->user->checkAccess('admin'))
//                    return true;
//            else {
//                throw new CHttpException(403,Yii::t('yii','У Вас недостаточно прав доступа.'));
//            }
            elseif(Yii::app()->user->checkAccess('readUser'))
            {
                return true;
            }
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }
}
