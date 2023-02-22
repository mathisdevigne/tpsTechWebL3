<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Framework\RequestConfig;

#[Route('/sandbox/injection', name: 'sandbox_injection')]
class InjectionController extends AbstractController
{

    #[Route('/un', name: '_un')]
    public function unAction(Request $request): Response
    {
        dump($request->getMethod(), $request->query->get('foo'), $request->query->all(), $request->cookies->all());
        return $this->render('sandbox/injection/index.html.twig', [
            'controller_name' => 'InjectionController',
        ]);
    }

    #[Route('/deux', name: '_deux')]
    public function deuxAction(Request $request, Session $session): Response
    {
        if(!is_null($request->query->get('compteur'))){
            $session->set(name: 'compteur', value: $request->query->get('compteur'));
        }
        if(!is_null($request->query->get('inc'))){
            $session->set(name: 'compteur', value: $session->get('compteur')+1);
        }
        if(!is_null($request->query->get('supp'))){
            $session->remove('compteur');
        }
        dump($session->all());
        dump($_SESSION);
        return $this->render('sandbox/injection/index.html.twig', [
            'controller_name' => 'InjectionController',
        ]);
    }

    #[Route('/permis/{age}', name: '_permis')]
    public function permisAction(int $age, Request $request, Session $session): Response
    {
        if($age<18){
            throw new NotFoundHttpException('Pas troiver');
        }
        return $this->render('sandbox/injection/index.html.twig', [
            'controller_name' => 'InjectionController',
        ]);
    }

    #[Route('/create-flash', name: '_create_flash')]
    public function createFlashAction(): Response
    {
        $this->addFlash("info", "FLASH FLASH");
        $this->addFlash("error", "big erreur");
        $this->addFlash("error", "ATTENTION");
        return $this->redirectToRoute("sandbox_injection_display_flash");
    }

    #[Route('/display-flash', name: '_display_flash')]
    public function displayFlashAction(): Response
    {
        return $this->render("Sandbox/injection/display.html.twig");
    }


}
