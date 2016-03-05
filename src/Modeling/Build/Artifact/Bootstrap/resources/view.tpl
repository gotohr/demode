{% extends "layout.twig" %}

{% block content %}

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= $this->e($name) ?></h3>
    </div>
    <div class="panel-body">
        <?php foreach ($props as $prop) : ?>
            <li><?= $this->e($prop) ?></li>
        <?php endforeach ?>
    </div>
</div>

{% endblock %}
