<?php

use yii\widgets\ListView;

?>
<div class="container">

<div class="row">
    <div class="col">
        <div class="archive-catagory">
            <a class="post-cata cata-sm cata-success"
               style="background-color: <?= $category['color'] ?>"><?= $category['name'] ?></a>
            <h4>Posts</h4>
        </div>
    </div>
</div>
    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => 'list',
    ]);
    ?>
</div>
</div>
