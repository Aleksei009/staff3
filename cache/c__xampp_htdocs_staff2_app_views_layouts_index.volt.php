


<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <?= $this->tag->linkTo(['index/index', 'saff_all_users']) ?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>

            </ul>

            <ul class="nav pull-right">
                <li  style="padding: 5px 10px;"><?= $this->tag->linkTo(['users/signIn', 'SignIn']) ?></li>
                <li  style="padding: 5px 10px;"><?= $this->tag->linkTo(['users/signUp', 'SignUp']) ?></li>

            </ul>
            
        </div>
    </nav>
</div>