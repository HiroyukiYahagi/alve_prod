<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

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

</head>
<body class="blue-grey lighten-5">
    <nav class="white">
        <a href="<?php echo $this->Url->build(["controller" => "Top", "action" => "index" ]);?>" class="brand-logo center">
            <?php echo $this->Html->image('logo.png', ['alt' => 'alve']);?>
            <span class="green-text">環境配慮バルブ登録システム</span>
        </a>
        <ul id="slide-out" class="side-nav fixed">
            <?= $this->cell('Nav', ['isAuth' => isset($isAuth) ? $isAuth : false])->render();?>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse green-text"><i class="fa fa-bars fa-3x fa-with"></i></a>
    </nav>

    <main>
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>

</body>
</html>
