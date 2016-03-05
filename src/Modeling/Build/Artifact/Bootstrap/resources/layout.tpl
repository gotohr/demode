<!DOCTYPE html>
<html>
<head>
    {% block head %}
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{% block title %}{% endblock %} - My Webpage</title>
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />
    {% endblock %}
</head>
<body>
    <div class="container-fluid">
        <div id="content">{% block content %}{% endblock %}</div>
        <div id="footer">
            {% block footer %}
            {% endblock %}
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>