<h4><?= __('Evaluation Result') ?></h4>

<div class="row">
    <h5>
        <i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
        <?= __('Evaluation Infomation') ?>
    </h5>
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s4">
                    <label><?= __('Product Name') ?></label>
                    <p><?php echo $product->name;?></p>
                </div>
                <div class="col s4">
                    <label><?= __('Model Number') ?></label>
                    <p><?php echo $product->model_number;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s4">
                    <label><?= __('Product Type') ?></label>
                    <p><?php echo $product->type;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s4">
                    <label><?= __('Operator Name') ?></label>
                    <p><?php echo $product->operator_name;?></p>
                </div>
                <div class="col s4">
                    <label><?= __('Last Edit Date') ?></label>
                    <p><?php echo $product->modified;?></p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <h5>
        <i class="fa fa-line-chart fa-with" aria-hidden="true"></i>
        <?= __('Evaluation Result') ?>
    </h5>

    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


<form method="post" action="#">
    <input type="hidden" name="id" value="<?php echo $product->id;?>">
    <div class="row">
        <h5>
            <i class="fa fa-file fa-with" aria-hidden="true"></i>
            <?= __('Create Result Sheat') ?>
        </h5>
        <div class="card">
            <div class="card-content">
                <?php foreach($answersMap as $key => $answers):?>
                    <div class="row">
                        <div class="col s12">
                        <h6><?php echo $key;?></h6>
                        <?php foreach($answers as $key => $answer):?>
                            <p>
                                <input type="checkbox" class="filled-in" id="filled-in-box_<?php echo $answer->id;?>" checked="checked" name="reported_<?php echo $answer->id;?>"/>
                                <label for="filled-in-box_<?php echo $answer->id;?>"><?php echo $answer->item_description;?></label>
                            </p>
                        <?php endforeach;?>
                        </div>
                    </div>
                <?php endforeach;?>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="product_info" class="materialize-textarea" name="product_info"><?php echo $product->product_comment;?></textarea>
                        <label for="product_info"><?= __('Product Information') ?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button class="submit btn waves-effect waves-light grey" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'createPdf']);?>"><?= __('Create PDF Sheat') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row fixed-button">
        <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'register']);?>"><?= __('Go to register') ?></button>
    </div>
</form>



<script>

$(function() {

    var ctx = $("#myChart");

    var labels = [];
    var dataset_data = [];
    <?php foreach ($results as $key => $value): ?>
        labels.push("<?php echo $key;?>");
        dataset_data.push("<?php echo $value;?>");
    <?php endforeach ?>

    var data = {
        labels: labels,
        datasets: [
            {
                label: "<?= __('Evaluation Result')?>",
                backgroundColor: "rgba(76,175,80,0.2)",
                borderColor: "rgba(76,175,80,1)",
                pointBackgroundColor: "rgba(76,175,80,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(76,175,80,1)",
                data: dataset_data
            },
        ]
    };

    var myRadarChart = new Chart(ctx, {
        type: 'radar',
        data: data,
        options: {
            scale: {
                ticks: {
                    min: -2,
                    max: 4,
                }
            }
        }
    });

});
</script>
