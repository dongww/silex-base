<?php
/**
 * User: dongww
 * Date: 14-3-20
 * Time: 上午10:11
 */

namespace DemoCompany\DemoProject\Controller;

use Dongww\SilexBase\Core\Controller;
use App\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class DemoController extends Controller
{
    public function indexAction(Application $app, $name)
    {
        $app->d('这是演示页面首页。');
        $app->d('用户自定义 Provider 演示：' . $app['hello']('SilexBase'));

        return $app->render('DemoCompany/DemoProject:index.twig', [
                'name' => $name
            ]/*, (new Response())
                ->setStatusCode(200)
                ->setSharedMaxAge(5)
        */);
    }

    public function footerAction(Application $app)
    {
        $app->d('这是演示页面页脚。');
        return $app->render('DemoCompany/DemoProject:footer.twig');
    }

    public function formAction(Application $app, Request $request)
    {
        $app->d('这是演示表单页面。');
        $data = array(
            'name'  => '张三',
            'email' => 'abc@gmail.com',
        );

        $form = $app->form($data)
            ->add('name', 'text', [
                'constraints' => [new Assert\NotBlank(), new Assert\Length(['min' => 2])],
                'label'       => '姓名'
            ])
            ->add('email')
            ->add('gender', 'choice', [
                'choices'  => [1 => 'male', 2 => 'female'],
                'expanded' => true,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            print_r($data);

            // redirect somewhere
//            return $app->redirect($app['url_generator']->generate('home'));
        }

        return $app->render('DemoCompany/DemoProject:form.twig', [
            'form' => $form->createView()
        ]);
    }

    public function loginAction(Application $app, Request $request)
    {
        $app->d('这是演示登录页面。');
        return $app->render('login.twig', array(
            'error'         => $app->trans($app['security.last_error']($request)),
            'last_username' => $app['session']->get('_security.last_username'),
        ));
    }
}