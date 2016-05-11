<h4><?= __('登録') ?></h4>
<blockquote>
    <?= __('以下の情報が公開されます。正しく入力されているかを確認してください。')?>
</blockquote>

<form method="post" action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'publish', $product->id]);?>">
    <input type="hidden" name="id" value="<?php echo $product->id;?>">
    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-user fa-with" aria-hidden="true"></i>
                <?= __('会社情報') ?>
            </h5>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6">
                            <label for="company_name">
                                <?= __('会社名') ?>
                            </label>
                            <p><?php echo $product->company->company_name;?></p>
                        </div>
                        <div class="col s6">
                            <label for="name_kana">
                                <?= __('会社名 ( カナ )') ?>
                            </label>
                            <p><?php echo $product->company->name_kana;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label for="company_url"><?= __('会社HP URL') ?></label>
                            <p id="company_url">
                                <?php echo $product->company->url;?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label for="latest_fomula">
                                <?= __('最近のしくみ評価実施日') ?>
                            </label>
                            <p>
                                <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->latest_fomula ])->render();?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-cog fa-with" aria-hidden="true"></i>
                <?= __('製品情報') ?>
            </h5>

            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="col s6">
                            <label>
                                <?= __('製品種別')?>
                            </label>
                            <p>
                                <?php echo $types[$product->type_id]->type_name;?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s6">
                            <label for="product_name">
                                <?= __('製品名') ?>
                            </label>
                            <p id="product_name"><?php echo $product->product_name;?></p>
                        </div>
                        <div class="col s6">
                            <label for="model_number">
                                <?= __('型番') ?>
                            </label>
                            <p id="model_number"><?php echo $product->model_number;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col s6">
                            <label for="product_info_url">
                                <?= __('製品HP URL') ?>
                            </label>
                            <p id="product_info_url"><?php echo $product->product_info_url;?></p>
                        </div>
                        <div class="col s6">
                            <label for="sales_date">
                                <?= __('発売日') ?>
                            </label>
                            <p id="sales_date">
                                <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->sales_date ])->render();?>
                            </p>
                        </div>
                    </div>


                    <?php if($evaluation_type):?>
                    <div class="row">
                        <div class="col s6">
                            <label>
                                <?= __('評価方法') ?>
                            </label>
                            <p>
                                <?= __('他製品と比較して評価')?>
                            </p>
                        </div>
                    </div>
                    <div id="compared-option" class="row">
                        <div class="col s6">
                            <label for="compared_product_name">
                                <?= __('比較対象製品名') ?>
                            </label>
                            <p id="compared_product_name"></p>
                        </div>
                        <div class=" col s6">
                            <label for="compared_model_number">
                                <?= __('比較対象製品型番') ?>
                            </label>
                            <p id="compared_model_number"></p>
                        </div>
                    </div>

                    <?php else:?>
                    <div class="row">
                        <div class="col s6">
                            <label>
                                <?= __('評価方法') ?>
                            </label>
                            <p>
                                <?= __('目標値と比較して評価')?>
                            </p>
                        </div>
                    </div>

                    <?php endif;?>

                </div>
            </div>

        </div>
    </div>

    <button class="submit btn waves-effect waves-light green" type="submit">
        <?= __('登録') ?>
    </button>

</form>


<script type="text/javascript">
function changeEvaluationType(mode){
    if(mode == 0){
        $('#compared-option').show();
    }else{
        $('#compared-option').hide();
    }
}
</script>
