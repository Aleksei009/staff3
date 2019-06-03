
<div>
    <?php if (($authUser['role'] == 'user')) { ?>

        <h1> You are auth <?= $authUser['name'] ?> this is your email: <?= $authUser['email'] ?></h1>

    <?php } ?>
   
</div>

