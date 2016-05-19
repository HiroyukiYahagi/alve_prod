<?php
$cakeDescription = 'Alve';
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

    <?= $this->Html->script('Chart.min.js') ?>

</head>
<body class="light-green lighten-5">
    <div class="navbar-fixed">
        <nav class="white">
            <div class="brand-logo">
                <?php echo $this->Html->image('logo.jpg', ['alt' => 'alve', 'class' => 'logo-img']);?>
                <?php echo $this->Html->image('logo.png', ['alt' => 'alve', 'class' => 'logo-img']);?>
                <span class="green-text">環境配慮バルブ登録制度(管理画面)</span>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col s8 offset-s2">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        </div>
    </div>

</body>
</html>
