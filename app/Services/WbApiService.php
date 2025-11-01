<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Stock;
use App\Models\Income;
use App\Models\Sale;
use App\Models\Order;

class WbApiService
{
    private $baseUrl = 'http://109.73.206.144:6969';
    private $apiKey = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

    public function fetchAllData()
    {
        $endpoints = [
            'stocks' => '/api/stocks',
            'incomes' => '/api/incomes',
            'sales' => '/api/sales',
            'orders' => '/api/orders',
        ];

        $results = [];

        foreach ($endpoints as $key => $endpoint) {
            try {
                $data = $this->fetchEndpoint($endpoint);

                if ($data && is_array($data)) {
                    $count = $this->saveData($key, $data);
                    $results[$key] = "$count records processed";
                } else {
                    $results[$key] = 'No data received';
                }
            } catch (\Exception $e) {
                Log::error("Error fetching $key: " . $e->getMessage());
                $results[$key] = 'Error: ' . $e->getMessage();
            }
        }

        return $results;
    }

    private function fetchEndpoint($endpoint)
    {
        $params = [
            'key' => $this->apiKey,
            'limit' => 100,
            'page' => 1,
            'dateFrom' => date('Y-m-d'),
            'dateTo' => date('Y-m-d'),
        ];

        try {
            $response = Http::timeout(60)
                ->retry(3, 2000)
                ->get($this->baseUrl . $endpoint, $params);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data'] ?? $data;
            }

            throw new \Exception("HTTP request failed: " . $response->status());

        } catch (\Exception $e) {
            Log::error("Connection error for $endpoint: " . $e->getMessage());
            throw new \Exception("Connection failed: " . $e->getMessage());
        }
    }

    private function saveData($type, $data)
    {
        $count = 0;

        foreach ($data as $item) {
            try {
                switch ($type) {
                    case 'stocks':
                        Stock::updateOrCreate(
                            ['item_id' => $item['nm_id'] ?? $item['item_id'] ?? null],
                            $this->mapStockData($item)
                        );
                        break;
                    case 'incomes':
                        Income::updateOrCreate(
                            ['income_id' => $item['incomeId'] ?? $item['id'] ?? null],
                            $this->mapIncomeData($item)
                        );
                        break;
                    case 'sales':
                        Sale::updateOrCreate(
                            ['sale_id' => $item['saleID'] ?? $item['id'] ?? null],
                            $this->mapSaleData($item)
                        );
                        break;
                    case 'orders':
                        Order::updateOrCreate(
                            ['order_id' => $item['orderId'] ?? $item['id'] ?? null],
                            $this->mapOrderData($item)
                        );
                        break;
                }
                $count++;
            } catch (\Exception $e) {
                Log::error("Error saving $type data: " . $e->getMessage());
            }
        }

        return $count;
    }

    private function mapStockData($item)
    {
        return [
            'item_id' => $item['nm_id'] ?? $item['item_id'] ?? null,
            'item_name' => $item['subject'] ?? $item['item_name'] ?? $item['supplier_article'] ?? null,
            'quantity' => $item['quantity'] ?? $item['stock'] ?? 0,
            'warehouse' => $item['warehouse_name'] ?? $item['warehouse'] ?? null,
            'supplier_article' => $item['supplier_article'] ?? null,
            'barcode' => $item['barcode'] ?? null,
            'price' => $item['price'] ?? $item['Price'] ?? 0,
            'brand' => $item['brand'] ?? null,
            'category' => $item['category'] ?? null,
        ];
    }

    private function mapIncomeData($item)
    {
        return [
            'income_id' => $item['incomeId'] ?? $item['id'] ?? null,
            'item_id' => $item['nmId'] ?? $item['item_id'] ?? null,
            'item_name' => $item['item_name'] ?? $item['name'] ?? null,
            'quantity' => $item['quantity'] ?? 0,
            'price' => $item['price'] ?? $item['Price'] ?? 0,
            'income_date' => isset($item['date']) ? date('Y-m-d H:i:s', strtotime($item['date'])) : null,
            'supplier_article' => $item['supplierArticle'] ?? $item['supplier_article'] ?? null,
            'warehouse' => $item['warehouse'] ?? $item['warehouseName'] ?? null,
            'status' => $item['status'] ?? null,
        ];
    }

    private function mapSaleData($item)
    {
        return [
            'sale_id' => $item['saleID'] ?? $item['id'] ?? null,
            'item_id' => $item['nmId'] ?? $item['item_id'] ?? null,
            'item_name' => $item['item_name'] ?? $item['name'] ?? null,
            'quantity' => $item['quantity'] ?? 0,
            'price' => $item['price'] ?? $item['Price'] ?? 0,
            'total_price' => $item['totalPrice'] ?? $item['total_price'] ?? 0,
            'sale_date' => isset($item['date']) ? date('Y-m-d H:i:s', strtotime($item['date'])) : null,
            'supplier_article' => $item['supplierArticle'] ?? $item['supplier_article'] ?? null,
            'warehouse' => $item['warehouse'] ?? $item['warehouseName'] ?? null,
            'order_id' => $item['orderId'] ?? $item['order_id'] ?? null,
        ];
    }

    private function mapOrderData($item)
    {
        return [
            'order_id' => $item['orderId'] ?? $item['id'] ?? null,
            'item_id' => $item['nmId'] ?? $item['item_id'] ?? null,
            'item_name' => $item['item_name'] ?? $item['name'] ?? null,
            'quantity' => $item['quantity'] ?? 0,
            'price' => $item['price'] ?? $item['Price'] ?? 0,
            'order_date' => isset($item['date']) ? date('Y-m-d H:i:s', strtotime($item['date'])) : null,
            'delivery_date' => isset($item['deliveryDate']) ? date('Y-m-d H:i:s', strtotime($item['deliveryDate'])) : null,
            'supplier_article' => $item['supplierArticle'] ?? $item['supplier_article'] ?? null,
            'warehouse' => $item['warehouse'] ?? $item['warehouseName'] ?? null,
            'status' => $item['status'] ?? null,
        ];
    }
}
