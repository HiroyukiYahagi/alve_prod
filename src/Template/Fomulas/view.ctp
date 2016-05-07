<h4><?= __('Evaluation Result') ?></h4>

<div class="row">
    <div class="title-and-item">
        <h5 class="card-title grey-text text-darken-4">
            <i class="fa fa-info-circle fa-with" aria-hidden="true"></i>
            <?= __('Evaluation Infomation') ?>
        </h5>
        <a class="btn-floating btn-large green" href='<?php echo $this->Url->build(["action" => "edit", $fomula->id ]);?>'>
            <i class="fa fa-pencil-square-o"></i>
        </a>
    </div>

    <div class="card">
        <div class="card-content">
            <div class="row">
                <div class="col s12">
                    <label><?= __('Formula Period') ?></label>
                    <p>
                    <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $fomula->fomula_start ])->render();?>~<?= $this->cell('DateTime', ['type'=> 'date', 'data' => $fomula->fomula_end ])->render();?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col s4">
                    <label><?= __('Operator Name') ?></label>
                    <p><?php echo $fomula->operator_name;?></p>
                </div>
                <div class="col s4">
                    <label><?= __('Last Edit Date') ?></label>
                    <p>
                        <?= $this->cell('DateTime', ['type'=> 'datetime', 'data' => $fomula->modified ])->render();?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <h5>
        <i class="fa fa-line-chart fa-with" aria-hidden="true"></i>
        <?= __('Evaluation Result') ?>
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
                label: "<?= __('Evaluation Result')?>",
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
