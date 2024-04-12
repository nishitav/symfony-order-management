<?php
namespace App\Service;

use App\Repository\OrderRepository;

class OrderService
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getOrdersPaginated(int $page, int $limit): array
    {
        // Fetch orders from repository using pagination logic
        $orders = $this->orderRepository->findPaginated($page, $limit);

        return $orders;
    }

    public function getOrder(int $orderId): array
    {
        // Fetch order from repository using orderId
        $order = $this->orderRepository->findSingle($orderId);

        return $order;
    }
}
