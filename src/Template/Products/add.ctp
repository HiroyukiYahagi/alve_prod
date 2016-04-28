<h4><?= __('New Products') ?></h4>

<form method="post" action="">

    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-user fa-with" aria-hidden="true"></i>
                <?= __('Operator Info') ?>
            </h5>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s6">  
                            <label for="operator_name">
                                <?= __('Operator Name') ?>
                            </label>
                            <input id="operator_name" type="text" name="operator_name" class="validate" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s6">
            <h5>
                <i class="fa fa-cog fa-with" aria-hidden="true"></i>
                <?= __('Product Info') ?>
            </h5>
            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="input-field col s12">
                            <select id="types" name="types">
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
                            <label for="model_number"><?= __('Model Number') ?></label>
                            <input id="model_number" type="text" name="model_number" class="validate" required/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s6">
            <h5>
                <i class="fa fa-cog fa-with" aria-hidden="true"></i>
                <?= __('Compared Product') ?>
            </h5>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="input-field col s12">
                            <label for="compared_product_name"><?= __('Product Name') ?></label>
                            <input id="compared_product_name" type="text" name="compared_product_name" class="validate" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="compared_model_number"><?= __('Model Number') ?></label>
                            <input id="compared_model_number" type="text" name="compared_model_number" class="validate" required/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col s12">
    <h5>
        <i class="fa fa-line-chart fa-with" aria-hidden="true"></i>
        <?= __('Evaluation') ?>
    </h5>
    </div>
    </div>

    <?php foreach ($evaluationHeadsMap as $key => $evaluationHeads): ?>

        <div class="row">
            <div class="col s12">
                <h5>
                    <?php echo $key; ?>
                </h5>


                <table class="tablesorter white striped z-depth-2">
                    <thead>
                        <tr>
                            <th style="width: 5%;"><?= __('Selected') ?></th>
                            <th style="width: 40%;"><?= __('Title') ?></th>
                            <th style="width: 15%;"><?= __('Units') ?></th>
                            <th style="width: 10%;"><?= __('New') ?></th>
                            <th style="width: 10%;"><?= __('Old') ?></th>
                            <th style="width: 10%;"><?= __('Results') ?></th>
                            <th style="width: 10%;"><?= __('Points') ?></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($evaluationHeads as $evaluationHead): ?>

                        <tr>
                            <td>
                                <?php if($evaluationHead->required == 0): ?>
                                <p>
                                    <input type="checkbox" id="selected_<?php echo $evaluationHead->id; ?>" />
                                    <label for="selected_<?php echo $evaluationHead->id; ?>"></label>
                                </p>
                                <?php else: ?>
                                <p class="red-text">
                                    <?= __('Required') ?>
                                </p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <p>
                                    <a class="modal-trigger black-text" href="#detail_modal_<?php echo $evaluationHead->id; ?>">
                                        <?php echo $evaluationHead->item_description; ?>
                                        <i class="fa fa-question fa-with" aria-hidden="true"></i>
                                    </a>
                                </p>
                                <div id="detail_modal_<?php echo $evaluationHead->id; ?>" class="modal">
                                    <div class="modal-content">
                                        <h5><?= __('Criteria')?></h5>
                                        <p><?php echo $evaluationHead->item_criteria; ?></p>
                                        <h5><?= __('Options')?></h5>
                                        <p><?php echo $evaluationHead->options; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat"><?= __('Confirm') ?></a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if(isset($evaluationHead->unit_category)):?>
                                <select id="units_<?php echo $evaluationHead->id; ?>" name="units">
                                    <?php foreach ($units[$evaluationHead->unit_category] as $unit):?>
                                        <option value="<?php echo $unit->id;?>"><?php echo $unit->name;?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php endif; ?>
                            </td>
                            <td>
                                <input id="new_value_<?php echo $evaluationHead->id; ?>" type="text" name="new_value_<?php echo $evaluationHead->id; ?>" class="validate" onblur="evalAjax(<?php echo $evaluationHead->id; ?>);" >
                            </td>
                            <td>
                                <input id="old_value_<?php echo $evaluationHead->id; ?>" type="text" name="old_value_<?php echo $evaluationHead->id; ?>" class="validate" onblur="evalAjax(<?php echo $evaluationHead->id; ?>);" >
                            </td>
                            <td>
                                <p id="result_<?php echo $evaluationHead->id; ?>">
                                    <?= __('-') ?>
                                </p>
                            </td>
                            <td>
                                <p id="point_<?php echo $evaluationHead->id; ?>">
                                    <?= __('-') ?>
                                </p>
                            </td>
                        </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>

    <?php endforeach; ?>

    <div class="row fixed-button">
        <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'save']);?>"><?= __('Save and Suspend') ?></button>
         <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'submit']);?>"><?= __('Submit') ?></button>
    </div>

</form>


<script type="text/javascript">
    
    function evalAjax(id) {

        var newValue = $('#new_value_'+id).val();
        var oldValue = $('#old_value_'+id).val();

        if(newValue.length == 0 || oldValue.length == 0)
            return;

        $.ajax({
            url: "<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'evaluate']);?>",
            type: "post",
            data: { 
                id: id,
                newValue : newValue,
                oldValue : oldValue,
             },
            dataType: "json",
            success : function(response){
                $('#result_' + response.id).text(response.data.result);
                $('#point_' + response.id).text(response.data.point);
            },
        });
    }

</script>
