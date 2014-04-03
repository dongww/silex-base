<?php
/**
 * User: dongww
 * Date: 14-1-28
 * Time: 下午3:32
 */

namespace Controllers;

use SilexBase\Core\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use SilexBase\Core\Controller;
use Symfony\Component\Validator\Constraints as Assert;

class DefaultController extends Controller
{
    public function indexAction(Application $app, $name)
    {
        $app->d('hello~');
        return new Response($app['twig']->render('Default/index.twig', array(
            'name' => $name
        ))/*, 200, array(
            'Cache-Control' => 's-maxage=5',
        )*/);
    }

    public function footerAction(Application $app)
    {
        return $app['twig']->render('Default/footer.twig');
    }

    public function formAction(Application $app, Request $request)
    {
        $data = array(
            'name' => '张三',
            'email' => 'abc@gmail.com',
        );

        $form = $app['form.factory']->createBuilder('form', $data)
            ->add('name', 'text', array(
                'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 2))),
                'label' => '姓名'
            ))
            ->add('email')
            ->add('gender', 'choice', array(
                'choices' => array(1 => 'male', 2 => 'female'),
                'expanded' => true,
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            print_r($data);

            // redirect somewhere
//            return $app->redirect($app['url_generator']->generate('home'));
        }

        return $app['twig']->render('Default/form.twig', array(
            'form' => $form->createView()
        ));
    }

    public function loginAction(Application $app, Request $request)
    {
        return $app['twig']->render('login.twig', array(
            'error' => $app['translator']->trans($app['security.last_error']($request)),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }
}