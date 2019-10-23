<?php
use yii\helpers\Url;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="xCard" align="cenrer">
                <h1>Вы успрешно забронировали места</h1><br>
                <div>
                    <?php foreach ($reservation['seats'] as $item):?>
                        <span style="padding-left: 5px"> Ряд-<?=$item['rowNumber'];?> Место-<?=$item['seatNumber'];?></span>
                    <?php endforeach;?>
                </div>
                <h3><?=$reservation['seansData'];?></h3><br>
                <h3><?=$reservation['seansHall'];?></h3><br>
                <h3><?=$reservation['seansFilmName'];?></h3><br>
                <h3>Номер бронирования - *<?=$reservation['seansData'];?>*</h3><br>
            </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="xCard" align="cenrer">
                <a href="<?=Url::to('/sesans/seanses-list')?>" class="btn btn-success">Готово</a>
            </div>
    </div>

</div>
