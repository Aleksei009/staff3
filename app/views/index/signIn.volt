{{ content() }}


{{ form('users/auth'), 'method': 'post' }}

    <div class="form-grope" style=" display: flex; flex-direction: column; ">
        {% if (form) %}

            {{ form.render("name") }}
            {{ form.render("email") }}
            {{ form.render("go") }}

        {% endif %}
    </div>

{{ end_form }}
