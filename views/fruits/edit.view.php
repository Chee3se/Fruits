<?php component('header', compact('page_title')); ?>

<a href="/show?id=<?= $fruit['id'] ?>">Back</a>

<h1>Edit a fruit</h1>

<form method="POST" action="/">
    <input type='hidden' name='_method' value='PATCH'/>
    <input type='hidden' name='id' value="<?= $fruit['id'] ?>"/>
    <label>
        Name:
        <input name='name' value="<?= $fruit['name'] ?>" />
    </label>
    <br><br>
    <?php if (isset($errors['name'])) { ?>
        <p><?= $errors['name'] ?></p>
    <?php } ?>
    <label>
        Calories:
        <input name='calories' value="<?= $fruit['calories'] ?>" />
    </label>
    <br><br>
    <?php if (isset($errors['calories'])) { ?>
        <p><?= $errors['calories'] ?></p>
    <?php } ?>
    <button>Update</button>
</form>

<?php component('footer') ?>