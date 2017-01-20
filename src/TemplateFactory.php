<?php

namespace BadHospitals;

require __DIR__ . '/../vendor/autoload.php';

use Mustache_Engine;

class TemplateFactory
{
    private $template_engine;

    public function __construct(Mustache_Engine $template_engine)
    {
        $this->template_engine = new Mustache_Engine(
            ['loader' => new \Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/views')]
        );
    }

    public function create_template(string $template_file, array $input)
    {
        return $this->template_engine->render($template_file, $input);
    }
}
