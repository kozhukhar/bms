<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Задачи на <?= date('d.m.Y')?></h1>

   <div class="container-fluid">
       <dvi class="row">
           <div>
               <table class="table table-responsive table-striped">
                   <thead>
                        <th>Задача</th>
                        <th>поставил</th>
                        <th>выполнил</th>
                        <th>статус</th>
                        <th>примечание</th>
                   </thead>
                   <tbody>
                   <tr>
                       <td>Варка</td>
                       <td>Начальник производсва</td>
                       <td>Пивовар</td>
                       <td>В процессе</td>
                       <td>Замена хмеля Cascade -> Citra</td>
                   </tr>
                   <tr></tr>
                   <tr></tr>
                   </tbody>
               </table>
           </div>
       </dvi>
   </div>

</div>
