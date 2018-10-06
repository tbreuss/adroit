<h2><?= $item['title'] ?></h2>
<p><?= $item['date'] ?></p>
<p><?= $item['text'] ?></p>

<p>
    <a class="pure-button" href="<?= $this->url(['/blog']) ?>">Back</a> |
    <a class="pure-button" onclick="return confirm('Are you sure?');" href="<?= $this->url(['/blog/' . $item['id'] . '/delete']) ?>">Delete</a>
</p>