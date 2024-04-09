<?php component('header', compact('page_title')); ?>

<a href="/">To home</a>

<h1><?= htmlspecialchars($fruit['name']) ?></h1>

<p><?= "One ".htmlspecialchars($fruit['name'])." has {$fruit['calories']} calories" ?></p>

<a href="/edit?id=<?= $fruit['id'] ?>">Edit</a>

<?php component('footer') ?>