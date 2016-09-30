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
                <?= __('評価対象製品情報') ?>
            </h5>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <label class="require"><i class="fa fa-star fa-with require" aria-hidden="true"></i><?= __('製品種別') ?></label>
                            <p><?php echo $type->type_name.$type->fomula.$type->purpose;?></p>
                            <input type="hidden" name="type_id" value="<?php echo $type->id;?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <label for="product_name" class="require"><i class="fa fa-star fa-with require" aria-hidden="true"></i><?= __('製品名') ?></label>
                            <input id="product_name" type="text" name="product_name" class="validate" required="true" value="<?php echo isset($product->product_name) ? $product->product_name: ''; ?>" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="model_number" class="require"><i class="fa fa-star fa-with require" aria-hidden="true"></i><?= __('型番') ?></label>
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
                        <div class="input-field col s12">     
                            <label for="product_tel"><?= __('製品問い合わせTEL') ?></label>
                            <input id="product_tel" type="text" name="product_tel" class="validate" value="<?php echo isset($product->product_tel) ? $product->product_tel: ''; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">     
                            <label for="sales_date" class="require"><i class="fa fa-star fa-with require" aria-hidden="true"></i><?= __('発売日') ?></label>
                            <input id="sales_date" class="datepicker" type="date" name="sales_date" class="validate" required value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => isset($product->sales_date) ? $product->sales_date : null ])->render();?>"/>
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
                             <?php if(isset($product->evaluations[0]->compared_product_name) && strlen($product->evaluations[0]->compared_product_name) > 0):?>
                            <p onclick="changeEvaluationType(0);">
                                <input name="evaluation_type" type="radio" id="evaluation_type_comp" checked value="0"/>
                                <label for="evaluation_type_comp"><?= __('自社従来製品')?></label>
                            </p>
                            <p onclick="changeEvaluationType(1);">
                                <input name="evaluation_type" type="radio" id="evaluation_type_none" value="1"/>
                                <label for="evaluation_type_none"><?= __('新規設計目標値')?></label>
                            </p>
                            <?php else: ?>
                            <p onclick="changeEvaluationType(0);">
                                <input name="evaluation_type" type="radio" id="evaluation_type_comp"  value="0"/>
                                <label for="evaluation_type_comp"><?= __('自社従来製品')?></label>
                            </p>
                            <p onclick="changeEvaluationType(1);">
                                <input name="evaluation_type" type="radio" id="evaluation_type_none" checked value="1"/>
                                <label for="evaluation_type_none"><?= __('新規設計目標値')?></label>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="compared-option">
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="compared_product_name" class="require"><i class="fa fa-star fa-with require" aria-hidden="true"></i><?= __('製品名') ?></label>
                                <input id="compared_product_name" type="text" name="compared_product_name" class="validate" required value="<?php echo isset($product->evaluations[0]->compared_product_name) ? $product->evaluations[0]->compared_product_name: ''; ?>" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">     
                                <label for="compared_model_number"><?= __('型番') ?></label>
                                <input id="compared_model_number" type="text" name="compared_model_number" class="validate" value="<?php echo isset($product->evaluations[0]->compared_model_number) ? $product->evaluations[0]->compared_model_number: ''; ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">     
                                <label for="compared_url"><?= __('製品HP URL') ?></label>
                                <input id="compared_url" type="text" name="compared_url" class="validate" value="<?php echo isset($product->evaluations[0]->compared_url) ? $product->evaluations[0]->compared_url: ''; ?>"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">     
                                <label for="compared_sales_date"><?= __('発売年') ?></label>
<!--                                 <input id="compared_sales_date" type="text" name="compared_sales_date" class="datepicker" value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => isset($product->evaluations[0]->compared_sales_date) ? $product->evaluations[0]->compared_sales_date : null ])->render();?>"/>  -->

                                <select name="compared_sales_date">
                                    <?php for ($i=date('Y') ; $i >= date('1954') ; $i--): ?>
                                        <option value="<?php echo $i;?>" <?php echo $i==$this->cell('DateTime', ['type'=> 'year', 'data' => isset($product->evaluations[0]->compared_sales_date) ? $product->evaluations[0]->compared_sales_date : null ])->render() ? 'selected': ''; ?> ><?php echo $i;?>年</option>
                                    <?php endfor; ?>
                                </select>

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
                    
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-ellipsis-h fa-with" aria-hidden="true"></i>
                <?= __('その他') ?>
            </h5>
            <div class="card">
                <div class="card-content">

                    <div class="row">
                        <div class="col s6">     
                            <label for="latest_fomula"><i class="fa fa-star fa-with" aria-hidden="true"></i><?= __('最近のしくみ評価実施日') ?></label>
                            <input id="latest_fomula" class="datepicker" type="date" name="latest_fomula" class="validate"  value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => isset($product->latest_fomula) ? $product->latest_fomula : ( isset($fomulaDate) ? $fomulaDate : null) ])->render();?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="product_comment"><?= __('製品説明（84字以内。評価結果開示シートに記載されます）') ?></label>
                            <textarea id="product_comment" class="materialize-textarea counted" type="text" name="product_comment" class="validate" length="84"><?php echo isset($product->product_comment) ? $product->product_comment: ''; ?></textarea>
                        </div>
                    </div>
                    <?php if(isset($product->register_date)): ?>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="update_comment"><?= __('登録更新内容') ?></label>
                            <textarea id="update_comment" class="materialize-textarea counted" type="text" name="update_comment" class="validate" length="84"><?php echo isset($product->update_comment) ? $product->update_comment: ''; ?></textarea>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="input-field col s12">     
                            <label for="model_comment"><?= __('製品評価に関する備考（150字以内。評価結果開示シートに記載されます）') ?></label>
                            <textarea id="model_comment" class="materialize-textarea counted" type="text" name="model_comment" class="validate" length="150"><?php echo isset($product->model_comment) ? $product->model_comment: ''; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(!is_null($evaluationHeadsMap)): ?>

    <div class="row">
        <div class="col s12">
            <h5>
                <i class="fa fa-line-chart fa-with" aria-hidden="true"></i>
                <?= __('評価') ?>
            </h5>
        </div>
    </div>

    <?php foreach ($evaluationHeadsMap as $key => $evaluationHeadMeds): ?>

        <div class="row">
            <div class="col s12">
                <h5>
                    <?php echo $key; ?>
                </h5>
                <blockquote>
                    単位に「その他」を選択した場合、備考に内容を記載してください。
                </blockquote>

                <table class="tablesorter white striped z-depth-2 table-for-product">
                    <thead>
                        <tr>
                            <th><?= __('選択') ?></th>
                            <th><?= __('項目') ?></th>
                            <th><?= __('単位') ?></th>
                            <th><?= __('データ(評価対象)') ?></th>
                            <th class="compared_label"><?= __('データ(比較対象)') ?></th>
                            <th><?= __('備考') ?></th>
                            <th><?= __('結果') ?></th>
                            <th><?= __('得点') ?></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($evaluationHeadMeds as $key => $evaluationHeads): ?>

                        <tr>
                            <td colspan="8"><b><?php echo $key; ?></b></td>
                        </tr>

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
                                        <h5><?= __('評価に用いる指標')?></h5>
                                        <p><?php echo $evaluationHead->item_criteria; ?></p>
                                        <br/>
                                        <h5><?= __('配点区分')?></h5>
                                        <p>
                                            <b>
                                                <?php echo $evaluationHead->allocation->allocation_name; ?>
                                            </b>
                                            <br/>
                                            <?php echo $evaluationHead->allocation->description; ?>
                                        </p>
                                        <br/>
                                        <h5><?= __('評価方法など')?></h5>
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
                                <input id="new_value_<?php echo $evaluationHead->id; ?>" type="text" name="new_value[<?php echo $evaluationHead->id; ?>]" class="validate" onblur="evalAjax(<?php echo $evaluationHead->id; ?>);" value="<?php echo isset($selectedValues[$evaluationHead->id]) ? $selectedValues[$evaluationHead->id] : ''; ?>" min="0.0">
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
                                <input id="old_value_<?php echo $evaluationHead->id; ?>" type="text" name="old_value[<?php echo $evaluationHead->id; ?>]" class="validate" onblur="evalAjax(<?php echo $evaluationHead->id; ?>);" value="<?php echo isset($selectedCompValues[$evaluationHead->id]) ? $selectedCompValues[$evaluationHead->id] : ''; ?>"  min="0.0">
                            </td>
                            <?php endif; ?>
                            <td>
                                <input id="other_unit_<?php echo $evaluationHead->id; ?>" type="text" name="other_unit[<?php echo $evaluationHead->id; ?>]" class="validate" value="<?php echo isset($selectedOptValues[$evaluationHead->id]) ? $selectedOptValues[$evaluationHead->id] : ''; ?>" >
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

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>

    <?php endforeach; ?>


    <?php endif; ?>

    <div class="row fixed-button">
        <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'save', isset($product->id) ? $product->id : null]);?>" onClick="javascript:stopDoubleClick(this)"><?= __('保存して中断') ?></button>
         <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Products', 'action' => 'submit', isset($product->id) ? $product->id : null]);?>" onClick="javascript:stopDoubleClick(this)"><?= __('評価結果確認') ?></button>
    </div>

</form>


<script type="text/javascript">
    function changeEvaluationType(mode){
        if(mode == 0){
            $('#compared-option').show();
            $('.compared_label').text("<?= __('データ(比較対象)') ?>");
        }else{
            $('#compared-option').hide();
            $('#compared_product_name').val(null);
            $('#compared_model_number').val(null);
            $('.compared_label').text("<?= __('新規設計目標値') ?>");
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


        <?php if(!is_null($evaluationHeadsMap)): ?>
            <?php foreach ($evaluationHeadsMap as $evaluationMeds): ?>
                <?php foreach ($evaluationMeds as $evaluationHeads): ?>
                    <?php foreach ($evaluationHeads as $evaluationHead): ?>
                        evalAjax(<?php echo $evaluationHead->id;?>);
                    <?php endforeach ?>
                <?php endforeach ?>
            <?php endforeach ?>
        <?php endif; ?>


        <?php if(!(isset($product->evaluations[0]->compared_product_name) && strlen($product->evaluations[0]->compared_product_name) > 0)):?>
            changeEvaluationType(1);
        <?php endif; ?>
    });

</script>
