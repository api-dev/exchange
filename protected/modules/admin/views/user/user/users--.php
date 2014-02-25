<h1>Пользователи</h1>
<div class="total">
    <div class="left">
    <div class="create-button">
     <?php
     echo CHtml::ajaxLink('Создать', '/admin/user/createuser/', array('update'=>'.right'), array('class'=>'btn-green btn'));
     ?>   
    </div>
    <?php
//    $group_array = UserGroup::getUserGroupArray();
//    $group_array['group_id'] = 'Все';
//    echo CHtml::radioButtonList('drop_group', '', $group_array,
//    array('onchange'=>"$.fn.yiiListView.update('yw0', {url: '/admin/user/?group_id='+$('#drop_group input:checked').val()})"));
    ?>
    <?php
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$data,
        'itemView'=>'user/_item', // представление для одной записи
        'ajaxUpdate'=>false, // отключаем ajax поведение
        'emptyText'=>'Нет пользователей',
        'template'=>'{sorter} {items} {pager}',
        'sorterHeader'=>'',
        'itemsTagName'=>'ul',
        'sortableAttributes'=>array('group_id','surname','name'),
        'pager'=>array(
            'class'=>'CLinkPager',
            'header'=>false,
            'prevPageLabel'=>'<',
            'nextPageLabel'=>'>',
            'lastPageLabel'=>'>>',
            'firstPageLabel'=>'<<'
        ),
    ));
    ?>
    </div>
    <div class="right">
        <? 
        if ($mess = Yii::app()->user->getFlash('message')){
            echo '<div class="message success">'.$mess.'</div>';
        }
        if ($view){
            echo $view;
        } else {?>
        <div class="faq">
            <h2>Некоторые существующие правила:</h2>
            <ol>
                <li>Каждый пользователь принадлежит какой-либо группе.</li>
                <li>У каждой группы есть свой уровень доступа. Чем ниже уровень, тем меньше прав.</li>
                <li>Можно редактировать свои данные, а так же данные пользователей меньших по уровню.</li>
                <li>Нельзя редактировать пользователей с равным либо большим уровнем.</li>
                <li>Можно присваивать права другим пользователям равные либо меньшие, чем свои собственные.</li>
                <li>Нельзя удалить самого себя, но можно удалить пользователей с меньшим уровнем.</li>
            </ol>
            <br><br>
            <h3>Как сменить пароль?</h3>
            <p>Для того, чтобы изменить пароль, откройте страницу редактирования пользователя и введите новый пароль в одноименное поле. Если поле оставить пустым, пароль останется прежним.</p>
            <br>
            <h3>Что делать если изменились права, а Вы все так же не можете ими воспользоваться?</h3>
            <p>Выйдите и войдите на сайт заново.</p>
        </div>
        <?}
        ?>
    </div>
</div>
<?php if($data->pagination->pageCount!=0) { 
    $c = ($data->pagination->pageCount+4);
    ?>
    <style>
    #search-index .pager ul.yiiPager li{
        width: <?php echo 100/($c>14?14:$c); ?>%;
    }
    </style>
<?php } ?>
<script>
    $(document).ready(function(){
        var start = new AjaxContentLoader();
        start.init('.left', '.ajax', '.right' ,false);
    });
</script>