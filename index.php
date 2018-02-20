<?php
require 'helpers.php';
require 'logic.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bill Splitter</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">


</head>
<body>

<div class="title">Bill Splitter</div>

<div class='container-fluid'>
    <div class='billSplitterForm'>
        <form method='GET' action='index.php'>
            <div class='row-fluid'>
                <label>Split how many ways?</label>
                <input type='text' name='splitTerm' value='<?= sanitize($splitTerm) ?>'/>
            </div>
            <div class='row-fluid'>
                <label>How much was the tab?</label>
                <input type='text' name='billAmount' value='<?= sanitize($billAmount) ?>'/>
            </div>

            <div class='row-fluid'>
                <label>How was the the service?</label>
                <select name='tipAmount'>
                    <!-- echo selected on appropriate tip amount selected for refresh -->
                    <option value='0' <?php if ($tipAmount == 0) echo 'selected' ?>>Choose tip...</option>
                    <option value='15' <?php if ($tipAmount == 15) echo 'selected' ?>>Poor (15%)</option>
                    <option value='18' <?php if ($tipAmount == 18) echo 'selected' ?>>Good (18%)</option>
                    <option value='20' <?php if ($tipAmount == 20) echo 'selected' ?>>Excellent (20%)</option>
                    <option value='25' <?php if ($tipAmount == 25) echo 'selected' ?>>Outstanding (25%)</option>
                </select>
            </div>

            <div class='row-fluid'>
                <label>Round up?</label>
                <input type='checkbox' name='roundUp' <?= ($roundUp) ? 'checked' : '' ?> />
            </div>

            <input type='submit' value='Calculate'>
        </form>
    </div>
</div>

<!-- show the correct alert upon first visiting page or submitting form -->
<?php if (($isSubmitted) && ($form->hasErrors)) : ?>
    <div class='alert alert-danger' role='alert'>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
    </div>
<?php elseif (($isSubmitted) && (!$form->hasErrors)): ?>
    <div class='alert alert-success' role='alert'>
        <p>You split <em>$<?= sanitize($billAmount) ?></em> into <em><?= sanitize($splitTerm) ?></em> ways with
            <em><?= sanitize($tipAmount) . '% tip' ?></em>.</p>
        <p>Bill split: Everyone owes <em>$<?= sanitize($result) ?> each</em></p>
    </div>
<?php else : ?>
    <div class='alert alert-info' role='alert'>
        <p>Welcome to Bill Splitter! Please enter the appropriate information into the form above.</p>
    </div>
<?php endif ?>

</body>
</html>