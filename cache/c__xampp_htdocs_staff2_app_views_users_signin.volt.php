
<?= $this->tag->form(['users/auth', 'method' => 'post']) ?>

    <div class="form-grope" style=" display: flex; flex-direction: column; ">
        <?php if (($form)) { ?>

            <?= $form->render('email') ?>
            <?= $form->render('password') ?>
            <?= $form->render('go') ?>

        <?php } ?>
    </div>

<?= $this->tag->endForm() ?>


