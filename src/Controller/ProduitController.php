<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit', name:'produit')]
class ProduitController extends AbstractController
{
    #[Route('', name: '_index',)]
    public function indexAction(): Response
    {
        return $this->redirectToRoute('produit_list', array('n'=>1));
    }

    #[Route('/list/{n}', name: '_list',
        requirements: ['n'=>'[1-9]\d*|0'],
        defaults: ['n'=>0])]
    public function listAction(int $n): Response
    {
        $products = [['id'=>1,'denomination'=>'yaourt', 'code'=>'123456','date_creation'=> date('01/01/2018'),'actif'=>0,'description'=>'desc','id_manuel'=>1],
            ['id'=>2,'denomination'=>'yaourtfraise', 'code'=>'123457','date_creation'=> date('01/01/2018'),'actif'=>0,'description'=>'desc','id_manuel'=>2],
            ['id'=>3,'denomination'=>'yaourtpomme', 'code'=>'123458','date_creation'=> date('01/01/2018'),'actif'=>0,'description'=>'desc','id_manuel'=>3],
        ];
        dump($products);
        return $this->render('produit/list.html.twig', array('params'=>$products));
    }


    #[Route('/view/{idProduit}', name: '_view',
        requirements: ['idProduit'=>'[1-9]\d*|0'],)]
    public function viewAction(int $idProduit): Response
    {
        $products = ['id'=>1,'denomination'=>'yaourt', 'code'=>'123456','date_creation'=> date('01/01/2018'),'actif'=>0,'description'=>'desc','id_manuel'=>1];
        dump($products);
        return $this->render('produit/view.html.twig', array('params'=>$products));
    }


    #[Route('/add', name: '_add',)]
    public function addAction(): Response
    {
        $this->addFlash('info', 'Ajout erreur dsl');
        return $this->redirectToRoute('produit_view', array('idProduit'=>3));
    }


    #[Route('/edit/{idProduit}', name: '_edit',
        requirements: ['idProduit'=>'[1-9]\d*|0'],)]
    public function editAction(int $idProduit): Response
    {
        $this->addFlash('info', 'Edit erreur dsl');
        return $this->redirectToRoute('produit_view', array('idProduit'=>$idProduit));
    }


    #[Route('/delete/{idProduit}', name: '_delete',
        requirements: ['idProduit'=>'[1-9]\d*|0'],)]
    public function deleteAction(int $idProduit): Response
    {
        $this->addFlash('info', 'Delete erreur dsl');
        return $this->redirectToRoute('produit_list');
    }

    #[Route('/pays/add', name: '_pays_add',)]
    public function paysAddAction(): Response
    {
        $this->addFlash('info', 'Pays erreur dsl');
        return $this->redirectToRoute('produit_view', array('idProduit'=>3));
    }

    #[Route('/magasin/add', name: '_magasin_add',)]
    public function magasinAddAction(): Response
    {
        $this->addFlash('info', 'Msymagasin erreur dsl');
        return $this->redirectToRoute('produit_view', array('idProduit'=>3));
    }

}
