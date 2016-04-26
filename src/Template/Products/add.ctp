<h4><?= __('New Products') ?></h4>

<form>

    <div class="content">
        <h5>
            <i class="fa fa-user fa-with" aria-hidden="true"></i>
            <?= __('Operator Info') ?>
        </h5>
        <div class="card">
            <div class="card-content">

                <div class="row">
                    <div class="input-field col s12">  
                        <label for="operator_name">
                            <?= __('Operator Name') ?>
                        </label>
                        <input id="operator_name" type="text" name="operator_name" class="validate" required>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <h5>
            <i class="fa fa-cog fa-with" aria-hidden="true"></i>
            <?= __('Product Info') ?>
        </h5>
        <div class="card">
            <div class="card-content">
                
                <div class="row">
                    <div class="input-field col s12">
                        <select id="types" multiple name="types">
                            <option value="" disabled selected><?= __('Please Select Input Types') ?></option>
                            <?php foreach ($types as $type):?>
                                <option value="<?php echo $type->id;?>"><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
                            <?php endforeach; ?>
                        </select>
                        <label><?= __('Product Type') ?></label>
                    </div>
                </div>
                
                <div class="row">
                    <div class="input-field col s12">                    
                        <label for="product_name"><?= __('Product Name') ?></label>
                        <input id="product_name" type="text" name="product_name" class="validate" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">                    
                        <label for="model_name"><?= __('Model Name') ?></label>
                        <input id="model_name" type="text" name="model_name" class="validate" required/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>