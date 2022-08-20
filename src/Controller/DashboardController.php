<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ParksData;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ParksData $parksData, PaginatorInterface $paginator, Request $request): Response
    {
        $response = $parksData->fetchParksDatabyState('CA');

        $pagination = $paginator->paginate($response['data'], $request->query->getInt('page', 1), /*page number*/
    3 /*limit per page*/);

        return $this->render('dashboard/index.html.twig', [
            // 'response' => $response,

            'pagination' => $pagination
        ]);
    }
}
