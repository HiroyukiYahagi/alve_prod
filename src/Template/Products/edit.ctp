<h4><?php echo $title; ?></h4>

<blockquote>
    <i class="fa fa-star fa-with" aria-hidden="true"></i>入力必須項目
</blockquote>

<form method="post" action="">
    <?php if(isset($product)):?>
        <input type="hidden" name="id" value="<?php echo $product->id;?>"/>
    <?php endif;?>

    <div class="row">
        <div class="col s6">
            <h5>
                <i class="fa fa-cog fa-with" aria-hidden="true"></i>
                <?= __('製品情報') ?>
            </h5>
            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="input-field col s12">
                            <select id="types" name="type_id">
                                <option value="" disabled selected><?= __('製品種別を選択してください') ?></option>
                                <?php foreach ($types as $type):?>
                                    <option value="<?php echo $type->id;?>" <?php echo isset($product)&&($type->id==$product->type_id) ? 'selected': ''; ?> ><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
                                <?php endforeach; ?>
                            </select>
                            <label><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('製品種別') ?></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="product_name"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('製品名') ?></label>
                            <input id="product_name" type="text" name="product_name" class="validate" required value="<?php echo isset($product->product_name) ? $product->product_name: ''; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="model_number"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('型番') ?></label>
                            <input id="model_number" type="text" name="model_number" class="validate" required value="<?php echo isset($product->model_number) ? $product->model_number: ''; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="product_info_url"><?= __('製品HP URL') ?></label>
                            <input id="product_info_url" type="text" name="product_info_url" class="validate" value="<?php echo isset($product->product_info_url) ? $product->product_info_url: ''; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">     
                            <label for="sales_date"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('発売日') ?></label>
                            <input id="sales_date" class="datepicker" type="date" name="sales_date" class="validate"  value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => isset($product->sales_date) ? $product->sales_date : null ])->render();?>"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s6">
            <h5>
                <i class="fa fa-cog fa-with" aria-hidden="true"></i>
                <?= __('比較対象製品情報') ?>
            </h5>
            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class=" col s12">
                            <label>
                                <?= __('比較方法') ?>
                            </label>
                            <p onclick="changeEvaluationType(0);">
                                <input name="evaluation_type" type="radio" id="evaluation_type_comp" checked value="0"/>
                                <label for="evaluation_type_comp"><?= __('他製品と比較して評価')?></label>
                            </p>
                            <p onclick="changeEvaluationType(1);">
                                <input name="evaluation_type" type="radio" id="evaluation_type_none" value="1"/>
                                <label for="evaluation_type_none"><?= __('目標値と比較して評価')?></label>
                            </p>

                        </div>
                    </div>
                    <div id="compared-option">
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="compared_product_name"><?= __('製品名') ?></label>
                                <input id="compared_product_name" type="text" name="compared_product_name" class="validate" value="<?php echo isset($product->evaluations[0]->compared_product_name) ? $product->evaluations[0]->compared_product_name: ''; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">     
                                <label for="compared_model_number"><?= __('型番') ?></label>
                                <input id="compared_model_number" type="text" name="compared_model_number" class="validate" value="<?php echo isset($product->evaluations[0]->compared_model_number) ? $product->evaluations[0]->compared_model_number: ''; ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-user fa-with" aria-hidden="true"></i>
                <?= __('作業者情報') ?>
            </h5>
            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="input-field col s6">
                            <label for="operator_name">
                                <?= __('作業者名') ?>
                            </label>
                            <input id="operator_name" type="text" name="operator_name" class="validate" value="<?php echo isset($product->operator_name) ? $product->operator_name : '' ;?>"/>
                        </div>
                        <div class="input-field col s6">
                            <label for="operator_department">
                                <?= __('作業部門') ?>
                            </label>
                            <input id="operator_department" type="text" name="operator_department" class="validate" value="<?php echo isset($product->operator_department) ? $product->operator_department : '' ;?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="operator_tel">
                                <?= __('作業者 TEL') ?>
                            </label>
                            <input id="operator_tel" type="text" name="operator_tel" class="validate" value="<?php echo isset($product->operator_tel) ? $product->operator_tel : '' ;?>"/>
                        </div>
                        <div class="input-field col s6">
                            <label for="operator_email">
                                <?= __('作業者 Email') ?>
                            </label>
                            <input id="operator_email" type="text" name="operator_email" class="validate" value="<?php echo isset($product->operator_email) ? $product->operator_email : '';?>"/>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-user fa-with" aria-hidden="true"></i>
                <?= __('その他') ?>
            </h5>
            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="col s6">     
                            <label for="latest_fomula"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('最近のしくみ評価実施日') ?></label>
                            <input id="latest_fomula" class="datepicker" type="date" name="latest_fomula" class="validate"  value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => isset($product->latest_fomula) ? $product->latest_fomula : null ])->render();?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="product_comment"><?= __('製品コメント') ?></label>
                            <textarea id="product_comment" class="materialize-textarea" type="text" name="product_comment" class="validate"><?php echo isset($product->product_comment) ? $product->product_comment: ''; ?></textarea>
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
                <?= __('評価') ?>
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
                            <th><?= __('選択') ?></th>
                            <th><?= __('項目') ?></th>
                            <th><?= __('単位') ?></th>
                            <th><?= __('値') ?></th>
                            <th><?= __('比較値') ?></th>
                            <th><?= __('結果') ?></th>
                            <th><?= __('得点') ?></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($evaluationHeads as $evaluationHead): ?>

                        <tr id="tr_<?php echo $evaluationHead->id;?>">
                            <td>
                                <?php if($evaluationHead->required == 0): ?>
                                <p>
                                    <input type="checkbox" id="selected_<?php echo $evaluationHead->id; ?>" name="selected[<?php echo $evaluationHead->id; ?>]" onchange="changeCheckButton(<?php echo $evaluationHead->id; ?>);"/>
                                    <label for="selected_<?php echo $evaluationHead->id; ?>"></label>
                                </p>
                                <?php else: ?>
                                <p>
                                    <i class="fa fa-star fa-with" aria-hidden="true"></i>
                                </p>
                                <input id="selected_<?php echo $evaluationHead->id; ?>" type="hidden" name="selected[<?php echo $evaluationHead->id; ?>]" value="on" checked="checked"/>
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
                                        <h5><?= __('判断基準')?></h5>
                                        <p><?php echo $evaluationHead->item_criteria; ?></p>
                                        <h5><?= __('その他情報')?></h5>
                                        <p><?php echo $evaluationHead->options; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat"><?= __('確認') ?></a>
                                    </div>
                                </div>
                            </td>
                            <?php if(isset($evaluationHead->unit_category)):?>
                            <td>
                                <select id="units_<?php echo $evaluationHead->id; ?>" name="units[<?php echo $evaluationHead->id; ?>]">
                                    <?php foreach ($units[$evaluationHead->unit_category] as $unit):?>
                                        <option class="unit_id_<?php echo $unit->id;?>" value="<?php echo $unit->id;?>" <?php echo (isset($selectedUnits[$evaluationHead->id]) && $selectedUnits[$evaluationHead->id] == $unit->id ) ? 'selected' : '' ;?> ><?php echo $unit->name;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <?php else: ?>
                            <td class="no-old"></td>
                            <?php endif; ?>
                            <?php if($evaluationHead->allocation->allocation_type!=0):?>
                            <td>
                                <input id="new_value_<?php echo $evaluationHead->id; ?>" type="number" name="new_value[<?php echo $evaluationHead->id; ?>]" class="validate" onblur="evalAjax(<?php echo $evaluationHead->id; ?>);" value="<?php echo isset($selectedValues[$evaluationHead->id]) ? $selectedValues[$evaluationHead->id] : ''; ?>" min="0">
                            </td>
                            <?php elseif($evaluationHead->allocation->allocation_type==0): ?>
                            <td class="no-old" colspan="2">
                                <select id="new_value_<?php echo $evaluationHead->id; ?>" name="new_value[<?php echo $evaluationHead->id; ?>]" onchange="evalAjax(<?php echo $evaluationHead->id; ?>);">
                                    <option value="" disabled selected>選択してください</option>
                                    <?php foreach ($evaluationHead->allocation->allocation_items as $allocation_item):?>
                                        <option class="new_value_<?php echo $allocation_item->id;?>" value="<?php echo $allocation_item->id;?>" <?php echo (isset($selectedValues[$evaluationHead->id] ) && $selectedValues[$evaluationHead->id] == $allocation_item->id ) ? 'selected' : '' ;?> ><?php echo $allocation_item->text;?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input id="old_value_<?php echo $evaluationHead->id; ?>" type="hidden" name="old_value[<?php echo $evaluationHead->id; ?>]" value="0">
                            </td>
                            <?php endif; ?>
                            <?php if($evaluationHead->allocation->allocation_type!=0):?>
                            <td>
                                <input id="old_value_<?php echo $evaluationHead->id; ?>" type="number" name="old_value[<?php echo $evaluationHead->id; ?>]" class="validate" onblur="evalAjax(<?php echo $evaluationHead->id; ?>);" value="<?php echo isset($selectedCompValues[$evaluationHead->id]) ? $selectedCompValues[$evaluationHead->id] : ''; ?>"  min="0">
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
        <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'save', isset($product->id) ? $product->id : null]);?>"><?= __('保存して中断') ?></button>
         <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'submit', isset($product->id) ? $product->id : null]);?>"><?= __('登録') ?></button>
    </div>

</form>


<script type="text/javascript">
    function changeEvaluationType(mode){
        if(mode == 0){
            $('#compared-option').show();
        }else{
            $('#compared-option').hide();
            $('#compared_product_name').val(null);
            $('#compared_model_number').val(null);
        }
    }

    function changeCheckButton(id){
        if($('#selected_' + id).attr('checked') == 'checked'){
            $('#selected_' + id).removeAttr('checked');
            successRow(id);
        }else{
            $('#selected_' + id).attr('checked', true);
            evalAjax(id);
        }
    }

    function evalAjax(evaluation_id) {
        var newValue = $('#new_value_'+evaluation_id).val();
        var oldValue = $('#old_value_'+evaluation_id).val();

        if(newValue == null || oldValue==null || newValue.length == 0 || oldValue.length == 0){
            $('#result_' + evaluation_id).text('-');
            $('#point_' + evaluation_id).text('-');
            if($('#selected_' + evaluation_id).attr('checked') == 'checked'){
                alertRow(evaluation_id);
            }
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
                $('#selected_' + response.evaluation_id).attr('checked', true);
                successRow(response.evaluation_id);
            },
        });
    }

    $(function(){
        <?php if(isset($product->evaluations[0])): ?>
        <?php foreach ($product->evaluations[0]->evaluation_items as $evaluation_item):?>
            $('#selected_<?php echo $evaluation_item->head_id;?>').attr("checked", "checked");
        <?php endforeach; ?>
        <?php endif;?>

        <?php foreach ($evaluationHeadsMap as $evaluationHeads): ?>
            <?php foreach ($evaluationHeads as $evaluationHead): ?>
                evalAjax(<?php echo $evaluationHead->id;?>);
            <?php endforeach ?>    
        <?php endforeach ?>
    });

</script>
