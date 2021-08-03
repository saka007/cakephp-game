<?php
$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php echo $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $cakeDescription ?>:
        <?php echo $this->fetch('title') ?>
    </title>
    <?php echo $this->Html->meta('icon') ?>

    <?php echo $this->Html->css('base.css'); ?>
    <?php echo $this->Html->css('cake.css'); ?>
    <?php echo $this->Html->css('game.css') ?>

    <?php echo $this->fetch('meta') ?>
    <?php echo $this->fetch('css') ?>
    <?php echo $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a  href="">COVID Monster Battle</a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a  href="/Users/index">HOME</a></li>
                <?php if ($currentUser != null): ?>
                    <li><a href="/Users/logout">LOGOUT</a></li>
                    <?php else : ?>
                    <li><a  href="/Users/login">LOGIN</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <?php echo $this->Flash->render() ?>
    <div class="container clearfix ">
        <?php echo $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php //echo $this->Html->script('script.js') ?>
    <?php echo $this->Html->script('game.js') ?>
</body>
</html>
