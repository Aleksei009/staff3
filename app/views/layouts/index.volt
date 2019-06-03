
{#  {{ content() }}#}

<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        {{ link_to('index/index','saff_all_users') }}

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
                <li  style="padding: 5px 10px;">{{ link_to('users/signIn', 'SignIn') }}</li>
                <li  style="padding: 5px 10px;">{{ link_to('users/signUp', 'SignUp') }}</li>

            </ul>
            {#<form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>#}
        </div>
    </nav>
</div>