<?php
namespace App\Repository;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderRepository
{
    private $jsonFilePath;

    public function __construct(string $jsonFilePath)
    {
        $this->jsonFilePath = $jsonFilePath;
    }

    public function findPaginated(int $page, int $limit): array
    {
        $orders = $this->readOrdersFromFile();
        $totalOrders = count($orders);
        $startIndex = ($page - 1) * $limit;
        $pagedOrders = array_slice($orders, $startIndex, $limit);

        return [
            'orders' => $pagedOrders,
            'total' => $totalOrders,
            'page' => $page,
            'perPage' => $limit,
        ];
    }

    public function findSingle(int $orderId): array
    {
        $orders = $this->readOrdersFromFile();

        $filteredArray = array_filter($orders, function($item) use ($orderId) {
            return $item['order_id'] == $orderId;
        });

        // Get the first element from the filtered array which is exact match
        $record = reset($filteredArray);
        
        if ($record) {
            return $record;
        } 

        throw new NotFoundHttpException('The record does not exist.');
    }

    private function readOrdersFromFile(): array
    {
        $filesystem = new Filesystem();

        if (!$filesystem->exists($this->jsonFilePath)) {
            throw new \RuntimeException('JSON file does not exist.');
        }

        $jsonContent = file_get_contents($this->jsonFilePath);
        $orders = json_decode($jsonContent, true);

        if ($orders === null) {
            throw new \RuntimeException('Failed to parse JSON content.');
        }

        return $orders;
    }
}
