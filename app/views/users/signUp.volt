



{{ form('users/create','method': 'post') }}

<div class="form-grope" style=" display: flex; flex-direction: column; ">

    {% if (form) %}

        {{ form.render("name") }}
        {{ form.render('email') }}
        {{ form.render('password') }}
        {{ form.render('Sign Up') }}



    {% endif %}

</div>

{{ end_form() }}