<?php component('header', compact('page_title')); ?>

    <a href="/">To home</a>

    <h1>Create a new fruit</h1>

    <form method="POST" action="/">
        <label>
            Name:
            <input name='name' value="<?= $fruit['name'] ?? '' ?>" />
        </label>
        <br><br>
        <?php if (isset($errors['name'])) { ?>
            <p><?= $errors['name'] ?></p>
        <?php } ?>
        <label>
            Calories:
            <input name='calories' value="<?= $fruit['calories'] ?? '' ?>" />
        </label>
        <br><br>
        <?php if (isset($errors['calories'])) { ?>
            <p><?= $errors['calories'] ?></p>
        <?php } ?>
        <button>Save</button>
    </form>

<?php component('footer') ?>