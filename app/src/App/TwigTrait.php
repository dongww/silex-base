<?php
namespace App;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Twig trait.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
trait TwigTrait
{
    /**
     * Renders a view and returns a Response.
     *
     * To stream a view, pass an instance of StreamedResponse as a third argument.
     *
     * @param string   $view       The view name
     * @param array    $parameters An array of parameters to pass to the view
     * @param Response $response   A Response instance
     *
     * @return Response A Response instance
     */
    public function render($view, array $parameters = array(), Response $response = null)
    {
        $view = $this->parseViewPath($view);
        $twig = $this['twig'];

        if ($response instanceof StreamedResponse) {
            $response->setCallback(function () use ($twig, $view, $parameters) {
                $twig->display($view, $parameters);
            });
        } else {
            if (null === $response) {
                $response = new Response();
            }
            $response->setContent($twig->render($view, $parameters));
        }

        return $response;
    }

    /**
     * Renders a view.
     *
     * @param string $view       The view name
     * @param array  $parameters An array of parameters to pass to the view
     *
     * @return Response A Response instance
     */
    public function renderView($view, array $parameters = array())
    {
        $view = $this->parseViewPath($view);

        return $this['twig']->render($view, $parameters);
    }

    protected function parseViewPath($view)
    {
        if (stripos($view, ':')) {
            $viewPathParts = explode(':', $view);
            $view          = $viewPathParts[0] . '/_resources/views/' . $viewPathParts[1];
        }

        return $view;
    }
}
