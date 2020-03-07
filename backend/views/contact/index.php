<?php

use yii\helpers\Url;

?>
<div class="container">
        <div class="row">
            <div class="col">
                <h2>You have <?= $count ?> new Message(s)</h2>
                <table class="table table-sm table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                        <th scope="col">Date</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($messages as $message):?>
                            <tr>
                                <th scope="row"><?=$message['id']?></th>
                                <td><?=$message['name']?></td>
                                <td><?=$message['email']?></td>
                                <td><?=$message['message']?></td>
                                <td><?=$message['created_at']?></td>
                                <td><a href="<?=Url::toRoute(['contact/delete', 'id' => $message['id']])?>">Delete</a></td>
                            </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
