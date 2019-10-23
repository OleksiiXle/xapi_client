<?php
$this->title = 'Выберите сеанс';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="xCard">
                <table class="table table-bordered table-hover table-condensed">
                    <?php foreach ($seansesList as $seans):?>
                    <tr class="seansChoise"
                        onclick="$('#seansId').val('<?=$seans['id'];?>'); $('#seansChoise').submit();">
                        <td><?=$seans['dataText'];?></td>
                        <td><?=$seans['hallName'];?></td>
                        <td><?=$seans['filmName'];?></td>
                    </tr>
                    <?php endforeach;?>
                </table>
                <form id="seansChoise" method="post">
                    <input type="hidden" name="_csrf-frontend" value="<?=Yii::$app->request->csrfToken;?>">
                    <input id="seansId" name="seansId" value="" hidden>
                </form>
            </div>

        </div>
    </div>
</div>
