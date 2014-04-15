<?php
    $header_form = '"'.$model->company . '"';
    $submit_text = 'Сохранить';
    $close_text = 'Закрыть';
    $delete_button = CHtml::link('Удалить', '/admin/user/deleteuser/id/'.$model->id, array('id'=>'del-user','class'=>'btn-admin btn-del', 'onclick'=>'return confirm("Внимание! Пользователь будет безвозвратно удален. Продолжить?")'));
    $action = '/admin/user/edituser/id/'.$model->id;
    $name = $model->id;
    if (!$model->id) {
        $submit_text = 'Создать';
        $header_form = '';
        $action = '/admin/user/createuser/';
        unset($delete_button);
    }
?>
<div class="total">
    <div class="left">
        <?php if (!$model->id): ?>
        <h1>Создание компании</h1>
        <?php else: ?>
        <h1>Редактирование компании</h1>
        <?php endif?>
        <div class="header-form">
            <?php echo $header_form; ?>
        </div>
        <div>Для того, чтобы вернуться к списку перевозок нажмите кнопку "<?php echo $close_text?>"
        </div>
    </div>
    <div class="right">
        <div class="form">
            <?php
                if ($mess = Yii::app()->user->getFlash('message')){
                    echo '<div class="uMessage success">'.$mess.'</div>';
                } else if ($mess = Yii::app()->user->getFlash('error')) {
                    echo '<div class="uMessage error">'.$mess.'</div>';
                }
            ?>
            <?php $form = $this->beginWidget('CActiveForm', array('id'=>'userform',
                'action'=>$action,
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                    'afterValidate'=>'js:function( form, data, hasError ) 
                        {     
                            if( hasError ){
                                return false;
                            }
                            else{
                                return true;
                            }
                        }'
                ),));
            ?>
            <div class="buttons">
            <?php
                echo CHtml::button($close_text,array('id'=>'close-user', 'class'=>'btn-admin'));
                echo $delete_button;
                echo CHtml::submitButton($submit_text,array('id'=>'but_'.$name,'class'=>'btn-admin')); 
            ?>
            </div>
            <div class="company field">
            <?php  echo $form->error($model, 'company'); 
                echo $form->labelEx($model, 'company');
                echo $form->textField($model, 'company'); ?>
            </div>
            <div class="inn field">
            <?php  echo $form->error($model, 'inn'); 
                echo $form->labelEx($model, 'inn');
                echo $form->textField($model, 'inn'); ?>
            </div>
            <div class="surname field">
            <?php  echo $form->error($model, 'surname'); 
                echo $form->labelEx($model, 'surname');
                echo $form->textField($model, 'surname'); ?>
            </div>
            <div class="name field">
            <?php  echo $form->error($model, 'name'); 
                echo $form->labelEx($model, 'name');
                echo $form->textField($model, 'name');?>
            </div>
            <div class="secondname field">
            <?php  echo $form->error($model, 'secondname'); 
                echo $form->labelEx($model, 'secondname');
                echo $form->textField($model, 'secondname'); ?>
            </div>
            <div class="password field">
            <?php  
                if ($model->id) {
                    echo $form->error($model, 'password_confirm');
                    echo $form->labelEx($model, 'password_confirm');
                    echo $form->passwordField($model, 'password_confirm');
                } else {
                    echo $form->error($model, 'password');
                    echo $form->labelEx($model, 'password');
                    echo $form->passwordField($model, 'password');
                }
            ?>
            </div>
            <div class="status field">
            <?php  echo $form->error($model, 'status');
                echo $form->labelEx($model, 'status');
                echo $form->dropDownList($model, 'status', User::$userStatus); ?>
            </div>
            <div class="reason field">
            <?php  echo $form->error($model, 'reason');
                echo $form->labelEx($model, 'reason');
                echo $form->textArea($model, 'reason'); ?>
            </div>
            <div class="country field">
            <?php  echo $form->error($model, 'country'); 
                echo $form->labelEx($model, 'country');
                echo $form->textField($model, 'country'); ?>
            </div>
            <div class="region field">
            <?php  echo $form->error($model, 'region'); 
                echo $form->labelEx($model, 'region');
                echo $form->textField($model, 'region'); ?>
            </div>
            <div class="city field">
            <?php  echo $form->error($model, 'city'); 
                echo $form->labelEx($model, 'city');
                echo $form->textField($model, 'city'); ?>
            </div>
            <div class="district field">
            <?php  echo $form->error($model, 'district'); 
                echo $form->labelEx($model, 'district');
                echo $form->textField($model, 'district'); ?>
            </div>
            <div class="phone field">
            <?php  echo $form->error($model, 'phone');
                echo $form->labelEx($model, 'phone');
                echo $form->textField($model, 'phone'); ?>
            </div>
            <div class="phone2 field">
            <?php  echo $form->error($model, 'phone2');
                echo $form->labelEx($model, 'phone2');
                echo $form->textField($model, 'phone2'); ?>
            </div>
            <div class="email field">
            <?php  echo $form->error($model, 'email');
                echo $form->labelEx($model, 'email');
                echo $form->emailField($model, 'email'); ?>
            </div>
            <?php if ($model->id): ?>
            <div style="display:none;">
            <?php  echo $form->hiddenField($model, 'password'); ?>
            </div>
            <?php endif; ?>
            <?php $this->endWidget();?> 
        </div>
    </div>
</div>
<script>
$(document).ready(function(){ 
    var activeStatus = parseInt(sessionStorage.getItem('userStatus'));
    if(!isNaN(activeStatus)) {
        var href = $('#del-user').attr('href');
        $('#del-user').attr('href', href + '/status/' + activeStatus);
    }
    $('#close-user').click(function(){
        if(isNaN(activeStatus)) document.location.href = "<?php echo Yii::app()->getBaseUrl(true) ?>/admin/user/";
        else document.location.href = "<?php echo Yii::app()->getBaseUrl(true) ?>/admin/user/index/status/" + activeStatus;
    });
    <?php if($model->status == User::USER_NOT_CONFIRMED || $model->status == User::USER_ACTIVE): ?>
    $('#UserForm_reason').parent().addClass('hide');
    <?php endif; ?>
    
    $('#UserForm_status').change(function(){
         if(this.value == <?php echo User::USER_NOT_CONFIRMED ?> || this.value == <?php echo User::USER_ACTIVE ?>){
             $('#UserForm_reason').parent().addClass('hide');
         } else {
             $('#UserForm_reason').parent().removeClass('hide');
         }
    });
});
</script>
