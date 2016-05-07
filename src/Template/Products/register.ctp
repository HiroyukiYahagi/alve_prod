<h4><?= __('Register') ?></h4>
<blockquote>
    以下の情報が公開されます。正しく入力されているかを確認してください。
</blockquote>

<form method="post" action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'publish', $product->id]);?>">
    <input type="hidden" name="id" value="<?php echo $product->id;?>">
    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-user fa-with" aria-hidden="true"></i>
                <?= __('Company Info') ?>
            </h5>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6">
                            <label for="company_name">
                                <?= __('Company Name') ?>
                            </label>
                            <p><?php echo $product->company->company_name;?></p>
                        </div>
                        <div class="col s6">
                            <label for="name_kana">
                                <?= __('Company Name ( kana )') ?>
                            </label>
                            <p><?php echo $product->company->name_kana;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label for="company_url"><?= __('Company URL') ?></label>
                            <p id="company_url">
                                <?php echo $product->company->url;?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s6">
                            <label for="latest_fomula">
                                <?= __('Latest Fomula Date') ?>
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
                <?= __('Product Info') ?>
            </h5>

            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="col s6">
                            <label>
                                <?= __('Product Type')?>
                            </label>
                            <p>
                                <?php echo $types[$product->type_id]->type_name;?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s6">
                            <label for="product_name">
                                <?= __('Product Name') ?>
                            </label>
                            <p id="product_name"><?php echo $product->product_name;?></p>
                        </div>
                        <div class="col s6">
                            <label for="model_number">
                                <?= __('Model Number') ?>
                            </label>
                            <p id="model_number"><?php echo $product->model_number;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col s6">
                            <label for="product_info_url">
                                <?= __('Product URL') ?>
                            </label>
                            <p id="product_info_url"><?php echo $product->product_info_url;?></p>
                        </div>
                        <div class="col s6">
                            <label for="sales_date">
                                <?= __('Sales Date') ?>
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
                                <?= __('Evaluation Type') ?>
                            </label>
                            <p>
                                <?= __('Compared with the following product')?>
                            </p>
                        </div>
                    </div>
                    <div id="compared-option" class="row">
                        <div class="col s6">
                            <label for="compared_product_name">
                                <?= __('Compared Product Name') ?>
                            </label>
                            <p id="compared_product_name"></p>
                        </div>
                        <div class=" col s6">
                            <label for="compared_model_number">
                                <?= __('Compared Product Model Number') ?>
                            </label>
                            <p id="compared_model_number"></p>
                        </div>
                    </div>

                    <?php else:?>
                    <div class="row">
                        <div class="col s6">
                            <label>
                                <?= __('Evaluation Type') ?>
                            </label>
                            <p>
                                <?= __('Compared with target value')?>
                            </p>
                        </div>
                    </div>

                    <?php endif;?>

                </div>
            </div>

        </div>
    </div>

    <button class="submit btn waves-effect waves-light green" type="submit">
        <?= __('Submit') ?>
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
