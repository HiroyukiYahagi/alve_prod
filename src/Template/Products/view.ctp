<h4><?= __('評価結果') ?></h4>

<div class="row">
    <div class="title-and-item">
        <h5 class="card-title grey-text text-darken-4">
            <i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
            <?= __('製品情報') ?>
        </h5>
        <a class="btn-floating btn-large green" href='<?php echo $this->Url->build(["action" => "edit", $product->id ]);?>'>
            <i class="fa fa-pencil-square-o"></i>
        </a>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s4">
                    <label><?= __('製品名') ?></label>
                    <p><?php echo $product->product_name;?></p>
                </div>
                <div class="col s4">
                    <label><?= __('型番') ?></label>
                    <p><?php echo $product->model_number;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s4">
                    <label><?= __('製品種別') ?></label>
                    <p><?php echo $product->type->type_name.$product->type->fomula.$product->type->purpose;?></p>
                </div>
            </div>

            <div class="row">
                <div class="col s4">
                    <label><?= __('製品HP URL') ?></label>
                    <p>
                        <?php echo isset($product->product_info_url) ? $product->product_info_url: ''; ?>
                    </p>
                </div>
                <div class="col s4">
                    <label><?= __('発売日') ?></label>
                    <p>
                    <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->sales_date ])->render();?>
                    </p>
                </div>
            </div>


            <div class="row">
                <div class="col s4">
                    <label><?= __('比較対象製品') ?></label>
                    <p>
                        <?php echo (isset($product->evaluations[0]->compared_product_name) && count($product->evaluations[0]->compared_product_name) == 0) ? $product->evaluations[0]->compared_product_name: __('目標値と比較して評価'); ?>
                    </p>
                </div>
                <div class="col s4">
                    <p>
                        <?php echo isset($product->evaluations[0]->compared_model_number) ? $product->evaluations[0]->compared_model_number: ''; ?>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col s4">
                    <label><?= __('最終更新日') ?></label>
                    <p>
                    <?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $product->modified ])->render();?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <h5>
        <i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
        <?= __('作業者情報') ?>
    </h5>
    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s4">
                    <label><?= __('作業者名') ?></label>
                    <p><?php echo $product->operator_name;?></p>
                </div>
                <div class="col s4">
                    <label><?= __('作業部門') ?></label>
                    <p><?php echo $product->operator_department;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col s4">
                    <label><?= __('作業者 TEL') ?></label>
                    <p><?php echo $product->operator_tel;?></p>
                </div>
                <div class="col s4">
                    <label><?= __('作業者 Email') ?></label>
                    <p><?php echo $product->operator_email;?></p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <h5>
        <i class="fa fa-line-chart fa-with" aria-hidden="true"></i>
        <?= __('結果') ?>
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
            <?= __('結果シート') ?>
        </h5>
        <div class="card">
            <div class="card-content">
                <?php foreach($answersMap as $key => $answers):?>
                    <div class="row">
                        <div class="col s12">
                        <h6><?php echo $key;?></h6>
                        <?php foreach($answers as $key => $answer):?>
                            <p>
                                <input type="checkbox" class="filled-in" id="filled-in-box_<?php echo $answer->id;?>" checked="checked" name="reported[<?php echo $answer->id;?>]"/>
                                <label for="filled-in-box_<?php echo $answer->id;?>"><?php echo $answer->item_description;?></label>
                            </p>
                        <?php endforeach;?>
                        </div>
                    </div>
                <?php endforeach;?>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="product_info" class="materialize-textarea" name="product_info"><?php echo $product->product_comment;?></textarea>
                        <label for="product_info"><?= __('製品コメント') ?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <button class="submit btn waves-effect waves-light grey" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'createPdf', $product->id]);?>"><?= __('PDFシートを作成する') ?></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row fixed-button">
        <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'register', $product->id]);?>"><?= __('製品情報を公開する') ?></button>
    </div>
</form>



<script>

$(function() {

    var ctx = $("#myChart");

    var labels = [];
    var dataset_data = [];
    <?php foreach ($scores as $key => $value): ?>
        labels.push("<?php echo $key;?>");
        dataset_data.push("<?php echo $value;?>");
    <?php endforeach ?>

    var data = {
        labels: labels,
        datasets: [
            {
                label: "<?= __('評価結果')?>",
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
