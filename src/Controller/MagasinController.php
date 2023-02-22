<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/magasin', name:'magasin')]
class MagasinController extends AbstractController
{
    #[Route('/valeur-stock/{idMagasin}', name: '_valeur_stock',
        requirements: ['idMagasin'=>'[1-9]\d*|0'],)]
    public function valeurStockAction(int $idMagasin): Response
    {
        return $this->render('magasin/valeurStock.html.twig', array('id'=>$idMagasin));
    }

    #[Route('/stock/{idMagasin}/{valMin}/{valMax}', name: '_stock_min_maw',
        requirements: ['idMagasin'=>'[1-9]\d*|0','valMin'=>'[1-9]\d*|0','valMax'=>'[1-9]\d*|0|-1'],
        defaults: ['valMin'=>0,'valMax'=>-1])]
    public function stockMinMaxAction(int $idMagasin,int $valMin,int $valMax): Response
    {
        return $this->render('magasin/valeurStock.html.twig', array('idMagasin'=>$idMagasin, 'valMin'=>$valMin,'valMax'=>$valMax));
    }
}
