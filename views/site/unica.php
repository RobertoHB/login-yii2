<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Probando acciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        La accion en que nos encontramos es <?= Html::encode($texto) ?>
    </p>

</div>
