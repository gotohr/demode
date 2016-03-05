$app->get('/<?=$this->e($name)?>', function () use ($app) {
    return $app['twig']->render('<?=$this->e($name)?>.twig');
});
