<h2>Add Item</h2>

<form method="post" action="/index.php/blog/create">
    Title: <input type="text" name="title"><br>
    Text: <textarea name="text"></textarea><br>
    <input type="submit" class="pure-button" value="Submit">
    <a href="<?= $this->url(['/blog']) ?>">Cancel</a>
</form>