<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($response['status']){
                echo '$response->isOk';
            } else {
                echo '$response->notOk';
            }
            echo ' returnStatus = ' . $response['status'] ;
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            echo var_dump($response['data']);
            ?>
        </div>
        <div class="col-md-3">
            <?php
            echo var_dump($response['headers']);
            ?>
        </div>
        <div class="col-md-3">
            <?php
            echo var_dump($response);
            ?>
        </div>
    </div>
</div>
