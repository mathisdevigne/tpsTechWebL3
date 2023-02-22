<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/sandbox/route', name:'sandbox_route')]
class RouteController extends AbstractController
{
    #[Route('', name: '')]
    public function index(): Response
    {
        return new Response("lol");
    }

    #[Route('/withvariable/{age}', name: '_withvariable')]
    public function withVariableAction(int $age): Response
    {
        return new Response("<body>Age : ".$age).'</body>';
    }

    #[Route('/withdefault/{age}', name: '_withdefault', defaults:['age' => 18])]
    public function withDefaultAction(int $age): Response
    {
        dump($age);
        return new Response("<body>Age : ".$age.'</body>');
    }

    #[Route('/withconstraint/{age}', name: '_withConstraint', requirements: ['age' => '0|[1-9]\d*'], defaults:['age' => 18])]
    public function withConstraintAction(int $age): Response
    {
        dump($age);
        return new Response("<body>Age : ".$age.'</body>');
    }

    #[Route('/test1/{year}/{month}/{filename}.{ext}', name: '_test1')]
    public function test1Action(int $year, int $month, string $filename, string $ext): Response
    {
        $args = array('params' => ['$year' => $year, '$month'=> $month, '$filename' => $filename, '$ext' => $ext],
        );
        return $this->render('Sandbox/route/test1234.html.twig', $args);
    }

    #[Route('/test2/{year}/{month}/{filename}.{ext}', name: '_test2',
        requirements: ['year' => '[1-9]\d{3}','month' => '0?[1-9]|1[0-2]','filename' => '([a-zA-Z]|-)+','ext' => '^(jpg|jpeg|png|ppm)$'])]
    public function test2Action(int $year, int $month, string $filename, string $ext): Response
    {
        $args = array('params' => ['$year' => $year, '$month'=> $month, '$filename' => $filename, '$ext' => $ext],
        );
        return $this->render('Sandbox/route/test1234.html.twig', $args);
    }

    #[Route('/test3/{year}/{month}/{filename}.{ext}', name: '_test3',
        requirements: ['year' => '[1-9]\d{3}','month' => '0?[1-9]|1[0-2]','filename' => '([a-zA-Z]|-)+','ext' => '^(jpg|jpeg|png|ppm)$'],
        defaults:['ext' => 'gif'] )]
    public function test3Action(int $year, int $month, string $filename, string $ext): Response
    {
        $args = array('params' => ['$year' => $year, '$month'=> $month, '$filename' => $filename, '$ext' => $ext],
        );
        return $this->render('Sandbox/route/test1234.html.twig', $args);
    }

    #[Route('/test4/{year}/{month}/{filename}.{ext}', name: '_test4',
        requirements: ['year' => '[1-9]\d{3}','month' => '0?[1-9]|1[0-2]','filename' => '([a-zA-Z]|-)+','ext' => '^(jpg|jpeg|png|ppm)$'],
        defaults:['month' => 1, 'filename' => 'picture', 'ext' => 'gif'] )]
    public function test4Action(int $year, int $month, string $filename, string $ext): Response
    {
        $args = array('params' => ['$year' => $year, '$month'=> $month, '$filename' => $filename, '$ext' => $ext],
        );
        return $this->render('Sandbox/route/test1234.html.twig', $args);
    }

    #[Route('/test4/{year}', name: '_test4encore',
        requirements: ['year' => '[1-9]\d{3}'])]
    public function test4EncoreAction(int $year): Response
    {
        $args = array('params' => ['$year' => $year],
        );
        return $this->render('Sandbox/route/test1234.html.twig', $args);
    }

    #[Route('/redirect1', name: '_redirect1')]
    public function redirect1Action(): Response
    {
        return $this->redirectToRoute('sandbox_prefix_hello4');
    }

    #[Route('/redirect2', name: '_redirect2')]
    public function redirect2Action(): Response
    {
        $params =  array('year' => 2014, 'month'=> 11, '$filename' => 'image', ) ;
        return $this->redirectToRoute('sandbox_route_test4', $params);
    }

    #[Route('/redirect3', name: '_redirect3')]
    public function redirect3Action(): Response
    {
        dump('bonjour');
        return $this->redirectToRoute('sandbox_prefix_hello4');
    }
}
