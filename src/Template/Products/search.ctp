<?php
$cakeDescription = 'Alve -環境配慮バルブ検索システム-';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>

    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>  

    <!-- material design lite -->
    <?= $this->Html->css('materialize.min.css') ?>
    <?= $this->Html->script('materialize.min.js') ?>

    <!-- font awasome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">    

    <script defer src="https://cdn.jsdelivr.net/tablesorter/2.17.4/js/jquery.tablesorter.min.js"></script>

    <!-- custom -->
    <?= $this->Html->css('alve.css') ?>
    <?= $this->Html->script('alve.js') ?>

</head>
<body class="blue-grey lighten-5">

    <nav class="white">
        <div class="brand-logo">
            <?php echo $this->Html->image('logo.jpg', ['alt' => 'alve', 'class' => 'logo-img']);?>
            <span class="green-text">環境配慮バルブ登録制度</span>
        </div>
    </nav>


    <div class="row">
        <div class="col s8 offset-s2">

            <h4><?= __('製品検索') ?></h4>
            <blockquote>
                【ご注意】<br/>
                ここに掲載されている製品は、会員企業が当工業会の定める評価項目に沿ってアセスメントを行い、自社従来製品又は新規設計目標値と比較し、環境側面で改善をしていると自己評価した製品です。<br/>
                会員企業の評価結果に対し、当工業会は一切責任を負いませんので、あらかじめご了承ください。製品についての詳細は、メーカー各社までお問い合わせいただけますよう、お願いいたします。
            </blockquote>


            <div class="row">
                <div class="card">
                    <form method="get" action="<?php echo $this->Url->build(["controller" => "Products", "action" => "search" ]);?>">
                        <div class="card-content">
                            <div class="row">
                                <div class="input-field col s12">
                                    <select id="options" multiple name="options[]">
                                        <option value="" disabled selected><?= __('製品種別を選択してください') ?></option>
                                        <?php foreach ($types as $type):?>
                                            <?php if(isset($query[$type->id])): ?>
                                            <option value="<?php echo $type->id;?>" selected><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
                                            <?php else: ?>
                                            <option value="<?php echo $type->id;?>"><?php echo $type->type_name.$type->fomula.$type->purpose;?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <label><?= __('製品種別') ?></label>
                                </div>
                            </div>

                            <button class="btn waves-effect waves-light green" type="submit" name="action"><?= __('検索') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if(isset($products)): ?>
        <div class="row">
            <div class="col s10 offset-s1">
                <table class="sorter tablesorter white striped z-depth-2">
                    <thead>
                        <tr>
                            <th><?= __('登録日') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                            <th><?= __('更新日') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                            <th><?= __('製品種別') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                            <th><?= __('会社名') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                            <th><?= __('製品名') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                            <th><?= __('型番') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                            <th><?= __('営業日') ?><i class="fa fa-sort fa-with" aria-hidden="true"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td>
                                    <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->created ])->render();?>
                                </td>
                                <td>
                                    <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->modified ])->render();?>
                                </td>
                                <td><?php echo $product->type->type_name.$product->type->fomula.$product->type->purpose;?></td>
                                <td>
                                    <?php if(strlen($product->company->url) != 0):?>
                                    <a href="<?php echo $product->company->url; ?>">
                                        <?php echo $product->company->company_name;?>
                                    </a>
                                    <?php else: ?>
                                    <?php echo $product->company->company_name;?>  
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(strlen($product->product_info_url) != 0):?>
                                    <a href="<?php echo $product->product_info_url; ?>">
                                        <?php echo $product->product_name;?>  

                                    </a>
                                    <?php else: ?>
                                    <?php echo $product->product_name;?>  
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $product->model_number;?></td>
                                <td>
                                    <?= $this->cell('DateTime', ['type'=> 'date', 'data' => $product->sales_date ])->render();?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </tbody>
            </table>
        </div>
    <?php endif; ?>


</body>
</html>
