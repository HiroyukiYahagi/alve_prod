<h4><?php echo $title; ?></h4>

<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $product->id;?>"/>
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
                            <input id="operator_name" type="text" name="operator_name" class="validate" required value="<?php echo isset($product->operator_name) ? $product->operator_name: ''; ?>">
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
                            <select id="types" name="type_id">
                                <option value="" disabled selected><?= __('Please Select Input Types') ?></option>
                                <?php foreach ($types as $type):?>
                                    <option value="<?php echo $type->id;?>" <?php echo $type->id==$product->type_id ? 'selected': ''; ?> ><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
                                <?php endforeach; ?>
                            </select>
                            <label><?= __('Product Type') ?></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="product_name"><?= __('Product Name') ?></label>
                            <input id="product_name" type="text" name="product_name" class="validate" required value="<?php echo isset($product->product_name) ? $product->product_name: ''; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="model_number"><?= __('Model Number') ?></label>
                            <input id="model_number" type="text" name="model_number" class="validate" required value="<?php echo isset($product->model_number) ? $product->model_number: ''; ?>"/>
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
                            <input id="compared_product_name" type="text" name="compared_product_name" class="validate" value="<?php echo isset($product->evaluations[0]->operator_name) ? $product->evaluations[0]->operator_name: ''; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="compared_model_number"><?= __('Model Number') ?></label>
                            <input id="compared_model_number" type="text" name="compared_model_number" class="validate" value="<?php echo isset($product->evaluations[0]->compared_model_number) ? $product->evaluations[0]->compared_model_number: ''; ?>"/>
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


                <table class="tablesorter white striped z-depth-2 table-for-product">
                    <thead>
                        <tr>
                            <th><?= __('Selected') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Units') ?></th>
                            <th><?= __('New') ?></th>
                            <th><?= __('Old') ?></th>
                            <th><?= __('Results') ?></th>
                            <th><?= __('Points') ?></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($evaluationHeads as $evaluationHead): ?>

                        <tr>
                            <td>
                                <?php if($evaluationHead->required == 0): ?>
                                <p>
                                    <input type="checkbox" id="selected_<?php echo $evaluationHead->id; ?>" name="selected[<?php echo $evaluationHead->id; ?>]" <?php echo isset($product->evaluations[0]->evaluation_items[$evaluationHead->id]) ? 'checked="checked"': ''; ?> />
                                    <label for="selected_<?php echo $evaluationHead->id; ?>"></label>
                                </p>
                                <?php else: ?>
                                <p class="red-text">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                </p>
                                <input type="hidden" name="selected[<?php echo $evaluationHead->id; ?>]" value="on" />
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
                            <?php if(isset($evaluationHead->unit_category)):?>
                            <td>
                                <select id="units_<?php echo $evaluationHead->id; ?>" name="units[<?php echo $evaluationHead->id; ?>]">
                                    <?php foreach ($units[$evaluationHead->unit_category] as $unit):?>
                                        <option value="<?php echo $unit->id;?>" <?php if(isset($product->evaluations[0]->evaluation_items[$evaluationHead->id]->unit_id)) echo $unit->id==$product->evaluations[0]->evaluation_items[$evaluationHead->id]->unit_id ? 'selected': ''; ?> ><?php echo $unit->name;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <?php else: ?>
                            <td class="no-old"></td>
                            <?php endif; ?>
                            <?php if($evaluationHead->allocation->allocation_type!=0):?>
                            <td>
                                <input id="new_value_<?php echo $evaluationHead->id; ?>" type="number" name="new_value[<?php echo $evaluationHead->id; ?>]" class="validate" onblur="evalAjax(<?php echo $evaluationHead->id; ?>);" value="<?php echo isset($product->evaluations[0]->evaluation_items[$evaluationHead->id]->value) ? $product->evaluations[0]->evaluation_items[$evaluationHead->id]->value: ''; ?>" min="0">
                            </td>
                            <?php elseif($evaluationHead->allocation->allocation_type==0): ?>
                            <td class="no-old" colspan="2">
                                <select id="new_value_<?php echo $evaluationHead->id; ?>" name="new_value[<?php echo $evaluationHead->id; ?>]" onchange="evalAjax(<?php echo $evaluationHead->id; ?>);">
                                    <option value="" disabled selected>Select</option>
                                    <?php foreach ($evaluationHead->allocation->allocation_items as $allocation_item):?>
                                        <option value="<?php echo $allocation_item->id;?>" <?php if(isset($product->evaluations[0]->evaluation_items[$evaluationHead->id])) echo $allocation_item->id==$product->evaluations[0]->evaluation_items[$evaluationHead->id]->value ? 'selected': ''; ?> ><?php echo $allocation_item->text;?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input id="old_value_<?php echo $evaluationHead->id; ?>" type="hidden" name="old_value[<?php echo $evaluationHead->id; ?>]" value="0">
                            </td>
                            <?php endif; ?>
                            <?php if($evaluationHead->allocation->allocation_type!=0):?>
                            <td>
                                <input id="old_value_<?php echo $evaluationHead->id; ?>" type="number" name="old_value[<?php echo $evaluationHead->id; ?>]" class="validate" onblur="evalAjax(<?php echo $evaluationHead->id; ?>);" value="<?php echo isset($product->evaluations[0]->evaluation_items[$evaluationHead->id]->compared_value) ? $product->evaluations[0]->evaluation_items[$evaluationHead->id]->compared_value: ''; ?>" min="0">
                            </td>
                            <?php endif; ?>
                            
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
    
    function evalAjax(evaluation_id) {
        var newValue = $('#new_value_'+evaluation_id).val();
        var oldValue = $('#old_value_'+evaluation_id).val();

        if(newValue == null || oldValue==null || newValue.length == 0 || oldValue.length == 0){
            $('#result_' + evaluation_id).text('-');
            $('#point_' + evaluation_id).text('-');
            return;
        }

        $.ajax({
            url: "<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'evaluate']);?>",
            type: "post",
            data: { 
                evaluation_id: evaluation_id,
                newValue : newValue,
                oldValue : oldValue,
             },
            dataType: "json",
            success : function(response){
                $('#result_' + response.evaluation_id).text(response.data.result);
                $('#point_' + response.evaluation_id).text(response.data.point);
                $('#selected_' + response.evaluation_id).attr('checked', 'checked');
            },
        });
    }

    $(function(){
        <?php foreach ($evaluationHeadsMap as $evaluationHeads): ?>
            <?php foreach ($evaluationHeads as $evaluationHead): ?>
                evalAjax(<?php echo $evaluationHead->id;?>);
            <?php endforeach ?>    
        <?php endforeach ?>
    });

</script>
