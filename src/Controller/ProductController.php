<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\formatTicketService;
use App\Service\TopSalesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductController extends AbstractController
{
    public function __construct(
        Private readonly TopSalesService $topSalesService,
        Private readonly formatTicketService  $formatTicketService,
    )
    {
    }

    #[Route('/api/top-sales', name: 'api_top_sales', methods: ['GET'])]
    public function getTopSales(): JsonResponse
    {
        $topSales = $this->topSalesService->getTopTenSales();

        if (empty($topSales)) {
            return new JsonResponse(['message' => 'Aucune vente trouvée'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($topSales, Response::HTTP_OK);
    }

    #[Route('/api/format', name: 'api_format_ticket', methods: ['GET'])]
    public function getFormatTicket(): JsonResponse
    {
        $ticketDeCaisse = '
            3 Soda LIGHT 33 CL. 6,60€
            2 Spaghetti Bolognaise (PETIT) 10,00€
            0,527 Salad Bar (kg) 8,53€
            1 Steak Haché 14,50€
            ';
        $topSales = $this->formatTicketService->formatTicket($ticketDeCaisse);

        return new JsonResponse($topSales, Response::HTTP_OK);
    }
}
