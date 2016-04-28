<h4><?= __('New Fomulas') ?></h4>

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
        <div class="col s12">
            <h5>
                <i class="fa fa-calendar fa-with" aria-hidden="true"></i>
                <?= __('Evaluation Term') ?>
            </h5>

            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6">  
                            <label for="fomula_start">
                                <?= __('Start') ?>
                            </label>
                              <input id="fomula_start" name="fomula_start" type="date" class="datepicker">
                        </div>
                        <div class="col s6">  
                            <label for="fomula_end">
                                <?= __('End') ?>
                            </label>
                              <input id="fomula_end" name="fomula_end" type="date" class="datepicker">
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

    <?php foreach ($fomulaHeadsMap as $key => $fomulaHeads): ?>

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
                            <th style="width: 35%;"><?= __('Value') ?></th>
                            <th style="width: 10%;"><?= __('Results') ?></th>
                            <th style="width: 10%;"><?= __('Points') ?></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($fomulaHeads as $fomulaHead): ?>

                        <tr>
                            <td>
                                <?php if($fomulaHead->required == 0): ?>
                                <p>
                                    <input type="checkbox" id="selected_<?php echo $fomulaHead->id; ?>" />
                                    <label for="selected_<?php echo $fomulaHead->id; ?>"></label>
                                </p>
                                <?php else: ?>
                                <p class="red-text">
                                    <?= __('Required') ?>
                                </p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <p>
                                     <?php echo $fomulaHead->item_description; ?>
                                </p>
                            </td>
                            <td>
                                <?php if(isset($fomulaHead->allocation->allocation_items) && !is_null($fomulaHead->allocation->allocation_items[0]->text) ): ?>
                                    <select id="value_<?php echo $fomulaHead->id; ?>" name="value_<?php echo $fomulaHead->id; ?>" onchange="evalAjax(<?php echo $fomulaHead->id; ?>);"  style="height: 100px;">
                                        <option value="" disabled selected><?= __('Please Select One') ?></option>
                                        <?php foreach ($fomulaHead->allocation->allocation_items as $allocation_item):?>
                                            <option value="<?php echo $allocation_item->id;?>"><?php echo $allocation_item->text;?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php else:?>
                                    <input id="value_<?php echo $fomulaHead->id; ?>" type="text" name="value_<?php echo $fomulaHead->id; ?>" class="validate" onblur="evalAjax(<?php echo $fomulaHead->id; ?>);" >
                                <?php endif; ?>
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

        var value = $('#value_'+id).val();
        if(value.length == 0){
            return;
        }

        $.ajax({
            url: "<?php echo $this->Url->build(['controller' => 'Fomulas', 'action' => 'evaluate']);?>",
            type: "post",
            data: { 
                id: id,
                value : value,
             },
            dataType: "json",
            success : function(response){
                $('#result_' + response.id).text(response.data.result);
                $('#point_' + response.id).text(response.data.point);
            },
        });
    }

</script>
