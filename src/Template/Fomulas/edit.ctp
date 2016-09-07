<h4><?php echo $title; ?></h4>

<blockquote>
    <i class="fa fa-star fa-with" aria-hidden="true"></i>入力必須項目
</blockquote>


<form method="post" action="">
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
                            <input id="operator_name" type="text" name="operator_name" class="validate" value="<?php echo isset($fomula->operator_name) ? $fomula->operator_name : ''; ?>">
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
                <?= __('評価情報') ?>
            </h5>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6">  
                            <label for="fomula_start">
                                <i class="fa fa-star fa-with" aria-hidden="true"></i>
                                <?= __('評価期間開始日') ?>
                            </label>
                             <input id="fomula_start" name="fomula_start" type="date" class="datepicker" required value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $fomula->fomula_start ])->render();?>"/>
                        </div>
                        <div class="col s6">
                            <label for="fomula_end">
                                <i class="fa fa-star fa-with" aria-hidden="true"></i>
                                <?= __('評価期間終了日') ?>
                            </label>
                            <input id="fomula_end" name="fomula_end" type="date" class="datepicker" required value="<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $fomula->fomula_end ])->render();?>"/>
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

    <?php foreach ($fomulaHeadsMap as $key => $fomulaHeadMeds): ?>

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
                            <th><?= __('今回評価') ?></th>
                            <th class="compared_label"><?= __('前回評価') ?></th>
                            <th><?= __('備考') ?></th>
                            <th><?= __('結果') ?></th>
                            <th><?= __('得点') ?></th>
                        </tr>
                    </thead>
                    <tbody>

                         <?php foreach ($fomulaHeadMeds as $key => $fomulaHeads): ?>

                        <tr>
                            <td colspan="8"><b><?php echo $key; ?></b></td>
                        </tr>

                        <?php foreach ($fomulaHeads as $fomulaHead): ?>
                        <tr id="tr_<?php echo $fomulaHead->id;?>">
                            <td>
                                <?php if($fomulaHead->required == 0): ?>
                                <p>
                                    <input type="checkbox" id="selected_<?php echo $fomulaHead->id; ?>" name="selected[<?php echo $fomulaHead->id; ?>]" onchange="changeCheckButton(<?php echo $fomulaHead->id; ?>);"/>
                                    <label for="selected_<?php echo $fomulaHead->id; ?>"></label>
                                </p>
                                <?php else: ?>
                                <p>
                                    <i class="fa fa-star fa-with" aria-hidden="true"></i>
                                </p>
                                <input id="selected_<?php echo $fomulaHead->id; ?>" type="hidden" name="selected[<?php echo $fomulaHead->id; ?>]" value="on" checked="checked"/>
                                <?php endif; ?>
                            </td>
                            <td>
                                <p>
                                    <a class="modal-trigger black-text" href="#detail_modal_<?php echo $fomulaHead->id; ?>">
                                        <?php echo $fomulaHead->item_description; ?>
                                        <i class="fa fa-question fa-with" aria-hidden="true"></i>
                                    </a>
                                </p>

                                <div id="detail_modal_<?php echo $fomulaHead->id; ?>" class="modal">
                                    <div class="modal-content">
                                        <h5><?= __('評価に用いる指標')?></h5>
                                        <p><?php echo $fomulaHead->item_criteria; ?></p>
                                        <br/>
                                        <h5><?= __('配点区分')?></h5>
                                        <p>
                                            <b>
                                                <?php echo $fomulaHead->allocation->allocation_name; ?>
                                            </b>
                                            <br/>
                                            <?php echo $fomulaHead->allocation->description; ?>
                                        </p>
                                        <?php if(isset($fomulaHead->options)): ?>
                                        <br/>
                                        <h5><?= __('評価方法など')?></h5>
                                        <p><?php echo $fomulaHead->options; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat"><?= __('確認') ?></a>
                                    </div>
                                </div>

                            </td>
                            <?php if(isset($fomulaHead->unit_category)):?>
                            <td>
                                <select id="units_<?php echo $fomulaHead->id; ?>" name="units[<?php echo $fomulaHead->id; ?>]">
                                    <?php foreach ($units[$fomulaHead->unit_category] as $unit):?>
                                        <option class="unit_id_<?php echo $unit->id;?>" value="<?php echo $unit->id;?>" <?php echo (isset($selectedUnits[$fomulaHead->id]) && $selectedUnits[$fomulaHead->id] == $unit->id ) ? 'selected' : '' ;?> ><?php echo $unit->name;?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <?php else: ?>
                            <td class="no-old"></td>
                            <?php endif; ?>
                            <?php if($fomulaHead->allocation->allocation_type!=0):?>
                            <td>
                                <input id="new_value_<?php echo $fomulaHead->id; ?>" type="text" name="new_value[<?php echo $fomulaHead->id; ?>]" class="validate" onblur="evalAjax(<?php echo $fomulaHead->id; ?>);" value="<?php echo isset($selectedValues[$fomulaHead->id]) ? $selectedValues[$fomulaHead->id] : ''; ?>" min="0">
                            </td>
                            <?php elseif($fomulaHead->allocation->allocation_type==0): ?>
                            <td class="no-old" colspan="2">
                                <select id="new_value_<?php echo $fomulaHead->id; ?>" name="new_value[<?php echo $fomulaHead->id; ?>]" onchange="evalAjax(<?php echo $fomulaHead->id; ?>);">
                                    <option value="" disabled selected>選択してください</option>
                                    <?php foreach ($fomulaHead->allocation->allocation_items as $allocation_item):?>
                                        <option class="new_value_<?php echo $allocation_item->id;?>" value="<?php echo $allocation_item->id;?>" <?php echo (isset($selectedValues[$fomulaHead->id] ) && $selectedValues[$fomulaHead->id] == $allocation_item->id ) ? 'selected' : '' ;?> ><?php echo $allocation_item->text;?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input id="old_value_<?php echo $fomulaHead->id; ?>" type="hidden" name="old_value[<?php echo $fomulaHead->id; ?>]" value="0">
                            </td>
                            <?php endif; ?>
                            <?php if($fomulaHead->allocation->allocation_type!=0):?>
                            <td>
                                <input id="old_value_<?php echo $fomulaHead->id; ?>" type="text" name="old_value[<?php echo $fomulaHead->id; ?>]" class="validate" onblur="evalAjax(<?php echo $fomulaHead->id; ?>);" value="<?php echo isset($selectedCompValues[$fomulaHead->id]) ? $selectedCompValues[$fomulaHead->id] : ''; ?>"  min="0.0">
                            </td>
                            <?php endif; ?>
                            <td>
                                <input id="other_unit_<?php echo $fomulaHead->id; ?>" type="text" name="other_unit[<?php echo $fomulaHead->id; ?>]" class="validate" value="<?php echo isset($selectedOptValues[$fomulaHead->id]) ? $selectedOptValues[$fomulaHead->id] : ''; ?>" >
                            </td>
                            <td>
                                <p id="result_<?php echo $fomulaHead->id; ?>">
                                    <?= __('-') ?>
                                </p>
                            </td>
                            <td>
                                <p id="point_<?php echo $fomulaHead->id; ?>">
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

    <div class="row fixed-button">
        <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Fomulas', 'action' => 'save', isset($fomula->id) ? $fomula->id : null]);?>"><?= __('保存して中断') ?></button>
         <button class="submit btn waves-effect waves-light green" type="submit" data-action="<?php echo $this->Url->build(['controller' => 'Fomulas', 'action' => 'submit', isset($fomula->id) ? $fomula->id : null]);?>"><?= __('登録') ?></button>
    </div>

</form>


<script type="text/javascript">

    function changeCheckButton(head_id){
        if($('#selected_' + head_id).attr('checked') == 'checked'){
            $('#selected_' + head_id).removeAttr('checked');
            successRow(head_id);
        }else{
            $('#selected_' + head_id).attr('checked', true);
            evalAjax(head_id);
        }
    }

    function evalAjax(head_id) {
        var newValue = $('#new_value_'+head_id).val();
        var oldValue = $('#old_value_'+head_id).val();

        if(newValue == null || oldValue==null || newValue.length == 0 || oldValue.length == 0){
            $('#result_' + head_id).text('-');
            $('#point_' + head_id).text('-');
            if($('#selected_' + head_id).attr('checked') == 'checked'){
                alertRow(head_id);
            }
            return;
        }

        $.ajax({
            url: "<?php echo $this->Url->build(['controller' => 'Fomulas', 'action' => 'evaluate']);?>",
            type: "post",
            data: { 
                head_id: head_id,
                newValue : newValue,
                oldValue : oldValue,
             },
            dataType: "json",
            success : function(response){
                $('#result_' + response.head_id).text(response.data.result);
                $('#point_' + response.head_id).text(response.data.point);
                $('#selected_' + response.head_id).attr('checked', true);
                successRow(response.head_id);
            },
        });
    }

    $(function(){
        <?php if(isset($fomula->fomula_items)): ?>
        <?php foreach ($fomula->fomula_items as $fomula_item):?>
            $('#selected_<?php echo $fomula_item->head_id;?>').attr("checked", "checked");
        <?php endforeach; ?>
        <?php endif;?>

        <?php if(!is_null($fomulaHeadsMap)): ?>
            <?php foreach ($fomulaHeadsMap as $fomulaHeadMeds): ?>
                <?php foreach ($fomulaHeadMeds as $fomulaHeads): ?>
                    <?php foreach ($fomulaHeads as $fomulaHead): ?>
                        evalAjax(<?php echo $fomulaHead->id;?>);
                    <?php endforeach ?>    
                <?php endforeach ?>
            <?php endforeach ?>
        <?php endif; ?>
    });

</script>
