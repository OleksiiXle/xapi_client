<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \frontend\assets\SeansAsset;

SeansAsset::register($this);

$this->title = 'Выберите места';

$this->registerJs("
    var _cinema_hall = '{$seans['cinema_hall']}';
",\yii\web\View::POS_HEAD);
?>
<?php
?>



<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="xCard">
                <div class="form-control">
                    <?=Html::encode($seans['dataText'])?>
                </div>
                <div class="form-control">
                    <?=Html::encode($seans['hallName'])?>
                </div>
                <div class="form-control">
                    <?=Html::encode($seans['filmName'])?>
                </div>
                <?php //echo var_dump($seans) ?>
            </div>
            <div class="xCard">
                <div id="rows" style="padding: 20px;"></div>
            </div>
            <div class="xCard">
                <?php $form = ActiveForm::begin(['id' => 'form-reservate',]); ?>
                <textarea id="reservation" name="reservation" cols="30" rows="2" hidden></textarea>
                <div class="form-group" align="center">
                    <?= Html::button('Забронировать', [
                        'class' => 'btn btn-primary',
                        'name' => 'signup-button',
                        'onclick' => 'reservate();'
                    ]) ?>
                    <?= Html::a('Отмена', '/seans/seanses-list',[
                        'class' => 'btn btn-danger', 'name' => 'reset-button'
                    ]);?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>


        </div>
    </div>
</div>
