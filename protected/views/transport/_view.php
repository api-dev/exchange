<?php
    $showAdditionalTimer = false;
    $status = $data->status;
    $lastRate = $this->getPrice($data->rate_id);
    $minPriceVal = $this->getMinPrice($data->id);
    $now = date('m/d/Y H:i:s', strtotime('now'));
    //$end = date('m/d/Y H:i:s', strtotime($data->date_from  . ' -' . Yii::app()->params['hoursBefore'] . ' hours'));
    $end = date('m/d/Y H:i:s', strtotime($data->date_close));
    if($end < $now && $status) {
        if(!empty($data->date_close_new)){
            $end = date('m/d/Y H:i:s', strtotime($data->date_close_new));
            if($end > $now) $showAdditionalTimer = true;
        }
    }
    $action = '/transport/description/id/'. $data->id . '/';
    
    $rate = '****';
    
    $currency = ' €';
    $type = 'международная';
    
    $allPoints = TransportInterPoint::getPointsMin($data->id, $data->location_to);
    if(!Yii::app()->user->isGuest){
        if(Yii::app()->user->isTransport){
            $model = UserField::model()->find('user_id = :id', array('id' => Yii::app()->user->_id));
            if((bool)$model->with_nds && $data->type == Transport::RUS_TRANSPORT){
                if(!empty($minPriceVal)) $rate = $minPriceVal + $minPriceVal * Yii::app()->params['nds'];
                else $rate = $data->start_rate + $data->start_rate * Yii::app()->params['nds'];
            } else {
                $rate = (!empty($minPriceVal))? $minPriceVal : $data->start_rate;
            }
        } else {
            $rate = (!empty($minPriceVal))? $minPriceVal : $data->start_rate;
        }
        $rate = ceil($rate);
        /// !!!
        if($rate%10 != 0) $rate -= $rate%10;
    }
    if($data->type==Transport::RUS_TRANSPORT){
        $type = "российская";
    } else { // international transport
        $pointsCustom = TransportInterPoint::model()->findAll(array('order'=>'sort desc', 'condition'=>'t_id = ' . $data->id, 'limit'=>1));
        $date_to_customs_clearance_RF = date('d.m.y', strtotime($pointsCustom[0]['date']));  
    }
    
    if(!$data->currency){
       $currency = ' руб.';
    } else if($data->currency == 1){
       $currency = ' $';
    }
?>
<div class="transport">
    <div class="width-50">
        <div class="width-100">
            <?php if(!Yii::app()->user->isGuest): ?>
            <div class="t-points"><span><a href="<?php echo $action; ?>"><?php echo $data->location_from . $allPoints . '<img class="arrow" src="/images/arrow.png" />' . $data->location_to ?></a></span></div>
            <?php else: ?>
            <div class="t-points"><span><?php echo $data->location_from . $allPoints . '<img class="arrow" src="/images/arrow.png" />' . $data->location_to ?></span></div>
            <?php endif; ?>
        </div>
        <div class="width-100">
            <div class="width-49">
                <span class="t-d-form-to">Дата загрузки: <?php echo date('d.m.y', strtotime($data->date_from)) ?></span>
            </div>
            <?php if($data->type == 0): ?>
            <div class="width-49">
                <span class="t-d-form-to">Дата доставки в пункт таможенной очистки в РФ: <?php echo $date_to_customs_clearance_RF; ?></span>
            </div>
            <?php else: ?>
            <div class="width-49">
                <span class="t-d-form-to">Дата разгрузки: <?php echo date('d.m.y', strtotime($data->date_to)); ?></span>
            </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($data->auto_info)): ?>
        <div class="width-100 transport-info">
            Транспорт: <?php echo $data->auto_info ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="width-50">
        <div class="width-40 t-description">
            <span><?php echo (!empty($data->description))? $data->description : '' ?></span>
        </div>
        <div class="width-30 v-center">
            <div class="t-rate">
                <span><?php echo $rate.$currency;?></span>
            </div>
        </div>
        <div class="width-30 v-center"> 
            <div class="t-timer <?php echo ($showAdditionalTimer)? 'add-t' : '' ?>" id="counter-<?php echo $data->id; ?>" t-id="<?php echo $data->id; ?>" now="<?php echo $now ?>" end="<?php echo $end ?>" status="<?php echo $status ?>"></div>
        </div>
    </div>
</div>
<script>
//$(document).ready(function(){
//    <?php //if(Yii::app()->user->isGuest || (!Yii::app()->user->isGuest && !Yii::app()->user->isTransport)): ?>
//    $('.t-timer').each(function(){
//       if(parseInt($(this).attr('status'))){
//           var timer = new Timer();
//           timer.init($(this).attr('now'), $(this).attr('end'), $(this).attr('id'), $(this).attr('status'), $(this).attr('t-id'));
//       } else {
//           $('#' + $(this).attr('id')).html('<span class="t-closed">Перевозка закрыта</span>');
//       }
//    });
//    <?php //endif; ?>
//});
</script>
