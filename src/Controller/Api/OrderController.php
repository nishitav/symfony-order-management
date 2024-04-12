<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\OrderService;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController extends AbstractController
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    #[Route('/api/orders', name: 'app_api_orders')]
    public function listOrders(Request $request): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 10);

        $orders = $this->orderService->getOrdersPaginated($page, $limit);

        return new JsonResponse($orders);
    }

    #[Route('/api/order/{id}', name: 'app_api_single_order')]
    public function getOrder(Request $request, int $id): JsonResponse
    {
        $order = $this->orderService->getOrder($id);

        return new JsonResponse($order);
    }
}
