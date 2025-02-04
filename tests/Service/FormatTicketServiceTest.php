<?php

namespace App\Tests\Service;

use App\Repository\ProductRepositoryInterface;
use App\Service\formatTicketService;
use App\Service\TopSalesService;
use PHPUnit\Framework\TestCase;

class FormatTicketServiceTest extends TestCase
{
    private formatTicketService $formatTicketService;

    public function setUp(): void
    {
        $this->formatTicketService = new formatTicketService();
    }

    public function testChangeTicket(): void
    {
        $ticketDeCaisse = '
            3 Soda LIGHT 33 CL. 6,60€
            2 Spaghetti Bolognaise (PETIT) 10,00€
            0,527 Salad Bar (kg) 8,53€
            1 Steak Haché 14,50€
            ';
        $expectedResult = '+3_SODA_LIGHT_33_CL_6,60E+2_SPAGHETTI_BOLOGNAISE_PETIT_10,00E+0,527_SALAD_BAR_KG_8,53E+1_STEAK_HACHE_14,50E+';
        $result = $this->formatTicketService->formatTicket($ticketDeCaisse);

        $this->assertEquals($expectedResult, $result);
    }
}
