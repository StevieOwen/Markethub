<?php

declare(strict_types=1);

namespace Framework;


use Psr\Http\Message\ResponseInterface;
use Framework\Template\RendererInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Framework\Template\Renderer;
use DI\Attribute\Inject;

abstract class Controller
{  
    #[inject]
    private ResponseFactoryInterface $factory ;
    #[inject]
    private RendererInterface $renderer;
    
    protected function render(string $template, array $data=[]):ResponseInterface
    {
         $content=$this->renderer->render($template, $data);
        $stream=$this->factory->createStream($content);
        $response=$this->factory->createResponse();

        $response=$response->withBody($stream);
        return $response;
    }

}