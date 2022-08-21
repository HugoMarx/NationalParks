<?php

namespace App\Controller;

use App\Form\StateSearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ParksData;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class DashboardController extends AbstractController
{
    private ParksData $parksData;
    public function __construct(ParksData $parksData)
    {
        $this->parksData = $parksData;
    }


    #[Route('/dashboard/{stateCode}', name: 'app_dashboard')]
    public function index(
        string $stateCode = 'all',
        PaginatorInterface $paginator,
        Request $request
    ): Response {

        $response = $stateCode === 'all' ? $this->parksData->fetchAllParks() : $this->parksData->fetchParksByState($stateCode);
        $currentState = array_search($request->attributes->get('stateCode'), StateSearchType::US_STATES, true);
        $searchForm = $this->createForm(StateSearchType::class);
        $searchForm->handleRequest($request);


        if ($searchForm->isSubmitted() && $searchForm->isValid()) {

            return $this->redirectToRoute('app_dashboard', ['stateCode' => $searchForm->getData()['state_name']]);
        }

        $pagination = $paginator->paginate(
            $response['data'],
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );
        
        return $this->render('dashboard/index.html.twig', [
            'currentState' => $currentState,
            'pagination' => $pagination,
            'search_form' => $searchForm->createView()
        ]);
    }
}
