<?php

namespace Project\TwigRenderer;

class TwigRenderer implements  Renderer
{
    public function render(string $path, array $params): string
    {
        $loader = new \Twig\Loader\FilesystemLoader('./views');
        $twig = new \Twig\Environment($loader);

        try {
            return $twig->render($path, $params);
        } catch (\Exception $exception) {
            return '';
        }
    }

}