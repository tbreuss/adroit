<h2>List Items</h2>

<table>
<?php foreach ($items as $item): ?>
    <tr>
        <td><?= $item['title'] ?></td>
        <td><a class="pure-button" href="<?= $this->url(['blog/' . $item['id']]) ?>">Detail</a></td>
    </tr>
<?php endforeach; ?>
</table>

<a class="pure-button" href="<?= $this->url(['blog/add']) ?>">Add Blog Post</a>