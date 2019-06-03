
<div>
    {% if (authUser['role'] == 'user') %}

        <h1> You are auth {{ authUser['name'] }} this is your email: {{ authUser['email'] }}</h1>

    {% endif %}
   {# <h1>Hello you were auth! {{ authUser['name'] }} </h1>
    <h3>This is your email address: {{ authUser['email'] }}</h3>#}
</div>

