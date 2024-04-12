# Symfony Order Management App
This Symfony application serves as a simple order management system. It reads order data from a JSON file and provides APIs to list orders and retrieve individual orders.

## Installation
1. Clone this repository.
2. Run `composer install` to install dependencies.
3. Start the Symfony server by running `symfony server:start`.


## API Reference

#### Get all orders

```http
  GET /api/order
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `page` | `integer` | **Required**. Default is 1 |
| `limit` | `integer` | **Required**. Default is 10 |


#### Get order

```http
  GET /api/order/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `integer` | **Required**. Id of order to fetch |


### Additional Notes
This application provides a basic understanding of how APIs are implemented in Symfony 7. While there are many libraries available to create APIs more quickly, this example offers a simple approach to understand the process.

Feel free to explore and modify the code to suit your needs!
