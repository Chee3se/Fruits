<?php component('header', compact('page_title')); ?>

<h1>Fruits</h1>

<form>
    <label>
        Calories less than...
        <input name='calories' value="<?= $_GET['calories'] ?? ''?>" />
    </label>
    <button>Filter</button>
</form>

<ul>
    <?php foreach ($fruits as $fruit) { ?>
        <li>One <a class="post" href="/show?id=<?= $post['id'] ?>"><?= htmlspecialchars($fruit['name']) ?></a> has <?= $fruit['calories'] ?>
            <form class="delete-form" method="POST" action="/">
                <input type='hidden' name='_method' value='DELETE'/>
                <input type='hidden' name='id' value="<?= $fruit["id"] ?>"/>
                <button>Delete</button>
            </form>
        </li>
    <?php } ?>
</ul>

<a href="/create">Create a fruit...</a>

<?php component('footer') ?>