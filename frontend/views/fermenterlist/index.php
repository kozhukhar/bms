<?php
/**
 * Created by PhpStorm.
 * User: mitron
 * Date: 2025-08-23
 * Time: 14:27
 */

$this->title = 'Управление пивобезакло';

use common\models\Fermenter;


?>



<?php
$fermenter = new Fermenter();
$fermenter->id = 1;
$fermenter->name = 'ЦКТ 1';
$fermenter->status = 0;
?>


<div class="container-fluid">
    <div class="row">
        <table>
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            </thead>
            <tbody>
            <tr>
                <td><?= $fermenter->id;?></td>
                <td><?= $fermenter->name;?></td>
                <td><?= $fermenter->status;?></td>
            </tr>
            </tbody>
        </table>

    </div>
</div>
