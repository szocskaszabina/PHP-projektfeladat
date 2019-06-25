<?php

namespace Project\TwigRenderer;

interface Renderer
{
    public function render(string $path, array $params): string;
}