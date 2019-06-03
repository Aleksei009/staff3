



<?= $this->tag->form(['users/create', 'method' => 'post']) ?>

<div class="form-grope" style=" display: flex; flex-direction: column; ">

    <?php if (($form)) { ?>

        <?= $form->render('name') ?>
        <?= $form->render('email') ?>
        <?= $form->render('password') ?>
        <?= $form->render('Sign Up') ?>



    <?php } ?>

</div>

<?= $this->tag->endForm() ?>