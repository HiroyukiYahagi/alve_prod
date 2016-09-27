<h4><?= __('評価結果') ?></h4>

<div class="row">
    <div class="title-and-item">
        <h5 class="card-title grey-text text-darken-4">
            <i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
            <?= __('製品情報') ?>
        </h5>
        <a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["action" => "downloadCsv", $product->id ]);?>'>
            <i class="fa fa-file fa-with"></i><?= __('CSV出力') ?>
        </a>
        <a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["action" => "edit", $product->id ]);?>' >
            <i class="fa fa-pencil-square-o fa-with"></i><?= __('製品評価に戻る') ?>
        </a>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s4">
                    <label><?= __('製品種別') ?></label>
                    <p><?php echo $product->type->type_name.$product->type->fomula.$product->type->purpose;?></p>
                </div>
            </div>
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
                    <label><?= __('製品HP URL') ?></label>
                    <p>
                        <?php echo isset($product->product_info_url) ? $product->product_info_url: ''; ?>
                    </p>
                </div>
                <div class="col s4">
                    <label><?= __('製品問い合わせTEL') ?></label>
                    <p>
                        <?php echo isset($product->product_tel) ? $product->product_tel: ''; ?>
                    </p>
                </div>
                <div class="col s4">
                    <label><?= __('発売日') ?></label>
                    <p>
                    <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->sales_date ])->render();?>
                    </p>
                </div>
            </div>

            <hr/>

            <div class="row">
                <?php if(isset($product->evaluations[0]->compared_product_name) && strlen($product->evaluations[0]->compared_product_name) > 0):?>
                <div class="col s3">
                    <label><?= __('比較対象製品') ?></label>
                    <p>
                        <?php echo $product->evaluations[0]->compared_product_name; ?>
                    </p>
                </div>
                <div class="col s3">
                    <label><?= __('比較対象製品型番') ?></label>
                    <p>
                        <?php echo $product->evaluations[0]->compared_model_number; ?>
                    </p>
                </div>
                <div class="col s3">
                    <label><?= __('製品HP URL') ?></label>
                    <p>
                        <?php echo $product->evaluations[0]->compared_url; ?>
                    </p>
                </div>
                <div class="col s3">
                    <label><?= __('発売年') ?></label>
                    <p>
                        <?= $this->cell('DateTime', ['type'=> 'year', 'data' => isset($product->evaluations[0]->compared_sales_date) ? $product->evaluations[0]->compared_sales_date : null ])->render() ?>
                    </p>
                </div>
                <?php else:?>
                <div class="col s4">
                    <label><?= __('比較対象製品') ?></label>
                    <p>
                        <?= __('目標値と比較して評価') ?>
                    </p>
                </div>
                <div class="col s4">
                </div>                    
                <?php endif; ?>
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
                <div class="col s4">
                    <label><?= __('作業者Email') ?></label>
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
            <?= __('評価結果開示シート作成') ?>
        </h5>
        <blockquote>
            評価結果開示シートに載せる項目にチェックを入れ、下の「作成」ボタンをクリックしてください。
        </blockquote>
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
                    <div class=" col s12">
                        <label for="product_comment"><?= __('製品説明') ?></label>
                        <p id="product_comment"><?php echo $product->product_comment;?></p>
                    </div>
                </div>
                <?php if(isset($product->update_comment) && strlen($product->update_comment) ): ?>
                <div class="row">
                    <div class="col s12">
                        <label for="update_comment"><?= __('登録更新内容') ?></label>
                        <p id="update_comment"><?php echo $product->update_comment;?></p>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class=" col s12">
                        <label for="model_comment"><?= __('製品評価に関する備考(評価結果開示シートに記載されます)') ?></label>
                        <p id="model_comment"><?php echo $product->model_comment;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <h5>
            <i class="fa fa-calendar-check-o fa-with" aria-hidden="true"></i>
            <?= __('登録日付') ?>
        </h5>
        <blockquote>
            ここで選択した日付が登録日(また登録更新日)として評価結果開示シート PDFに記載されます。PDF作成後の修正はできませんのでご注意ください。
        </blockquote>
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class=" col s6">
                        <label for="register_date"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('登録日') ?></label>
                        <input id="register_date" class="datepicker" type="date" name="register_date" class="validate" required value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => isset($product->register_date) ? $product->register_date : null ])->render();?>"/>
                    </div>
                    <?php if(isset($product->register_date)): ?>
                    <div class=" col s6">
                        <label for="register_update_date"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('登録更新日') ?></label>
                        <input id="register_update_date" class="datepicker" type="date" name="register_update_date" class="validate" required value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => isset($product->register_update_date) ? $product->register_update_date : null ])->render();?>"/>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row fixed-button">
        <a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["controller" => "Companies", "action" => "view"]);?>' >
            <i class="fa fa-pencil-square-o fa-with"></i><?= __('保存して中断') ?>
        </a>
        <a class="waves-effect waves-light btn green" href='<?php echo $this->Url->build(["action" => "edit", $product->id ]);?>' >
            <i class="fa fa-pencil-square-o fa-with"></i><?= __('製品評価に戻る') ?>
        </a>
        <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'register', $product->id]);?>"><?= __('評価結果開示内容確認') ?></button>
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
