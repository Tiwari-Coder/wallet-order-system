# Wallet & Order Management System API

## 📌 Project Overview

This project is a backend service built using **PHP (Laravel)** and **MySQL** that simulates a wallet-based transaction system.

It allows users to:

* Register and authenticate
* Manage wallet balance
* Perform wallet transactions
* Create orders using wallet balance

The system follows proper **database design, REST API structure, and transactional business logic**, similar to real-world fintech and e-commerce platforms.

## Tech Stack

* PHP (Laravel Framework)
* MySQL
* REST APIs
* Laravel Sanctum (Token Authentication)
* Postman (API Testing)

---

## Database Design

### Tables

* `users`
* `wallet_accounts`
* `wallet_transactions`
* `orders`

### Relationships

* One User → One Wallet Account
* One Wallet → Many Transactions
* One User → Many Orders

---

## Table Structure

### 🔹 users

* id
* name
* email
* password
* created_at
* updated_at

### 🔹 wallet_accounts

* id
* user_id
* balance
* created_at
* updated_at

### 🔹 wallet_transactions

* id
* user_id
* amount
* type (credit/debit)
* reference_id
* created_at
* updated_at

### 🔹 orders

* id
* user_id
* brand_id (nullable)
* amount
* status
* created_at
* updated_at

---

## Authentication APIs

### Register

**POST** `/api/auth/register`

```json
{
  "name": "test",
  "email": "test@example.com",
  "password": "123456"
}

Response:
{
    "message": "User registered successfully",
    "user": {
        "name": "test",
        "email": "test@example.com",
        "updated_at": "2026-03-19T09:06:11.000000Z",
        "created_at": "2026-03-19T09:06:11.000000Z",
        "id": 1
    }
}

---

### Login

**POST** `/api/auth/login`

```json
{
  "email": "test@example.com",
  "password": "123456"
}
```

**Response:**

```json
{
    "message": "Login successful",
    "access_token": "1|buZYO5sewZcaLjIdaNCP9qMMnbnwJpp2N7HkCx4kb425e634",
    "token_type": "Bearer"
}

```

### Get Authenticated User

**GET** `/api/auth/me`

**Header:**

```
Authorization: Bearer TOKEN
```

## Wallet APIs

### Deposit Money

**POST** `/api/wallet/deposit`

```json
{
  "amount": 1000
}

**Response:**
Authorization: Bearer Token         WBObLAS1YmBMleLFQxR6BtBe6sbJYqMBPCuJSMaR9daf57ec
{
    "message": "Deposit successful",
    "balance": 1000
}

```
### Order
**POST**   /api/orders
{
  "amount": 200
}

**Response:**
{
    "message": "Order created successfully",
    "balance": 800
}


### Get Balance

**GET** `/api/wallet/balance`

**Response:**

```json
{
  "user_id": 1,
  "balance": "800.00"
}
```
### Get Balance
**GET**   /api/orders

**Response:**
[
    {
        "id": 1,
        "user_id": 1,
        "brand_id": null,
        "amount": "200.00",
        "status": "pending",
        "created_at": "2026-03-19T09:40:16.000000Z",
        "updated_at": "2026-03-19T09:40:16.000000Z"
    }
]

---
  ## GET Order by IDs
  GET  api/orders/1

 **Response:**
  {
    "id": 1,
    "user_id": 1,
    "brand_id": null,
    "amount": "200.00",
    "status": "pending",
    "created_at": "2026-03-19T09:40:16.000000Z",
    "updated_at": "2026-03-19T09:40:16.000000Z"
}


All operations are handled using **database transactions** to ensure:

* Data consistency
* Atomic operations
* No partial updates
---
## Database Setup

1. Create a MySQL database on your server.
2. Import the provided `database/wallet_db.sql` file using phpMyAdmin.

## Testing

All APIs have been tested using **Postman**.

### Covered Test Cases:

* User registration & login
* Wallet deposit
* Order creation
* Balance deduction
* Insufficient balance handling

---

## Live Demo

(https://walletsystem.rf.gd/)

This project is live on InfinityFree Free Hosting for demonstration purposes.
APIs are fully functional and can be tested using Postman or any API client.
For optimal performance and full POST API support, you can run the project locally or on any cloud/paid hosting.
The system is designed with Laravel, MySQL, and follows best practices for wallet and order management.

---

## Assumptions

* Each user has only one wallet
* Wallet balance is used for all transactions
* Orders require sufficient balance
* All transactions are recorded

---

## Author

**Suman Tiwari**

---

## Status

* ✔ All APIs implemented
* ✔ Business logic verified
* ✔ Fully tested and working
* ✔ Ready for deployment 
