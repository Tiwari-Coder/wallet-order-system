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
```

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
  "access_token": "TOKEN",
  "token_type": "Bearer"
}
```

---

### Get Authenticated User

**GET** `/api/auth/me`

**Header:**

```
Authorization: Bearer TOKEN
```

---

## 💰 Wallet APIs

### Get Balance

**GET** `/api/wallet/balance`

**Response:**

```json
{
  "user_id": 1,
  "balance": "800.00"
}
```

---

### Deposit Money

**POST** `/api/wallet/deposit`

```json
{
  "amount": 1000
}
```

---

### Get Transactions

**GET** `/api/wallet/transactions`

---

## Order APIs

### Create Order

**POST** `/api/orders`

```json
{
  "amount": 200
}
```

**Response:**

```json
{
  "message": "Order created successfully",
  "balance": 800
}
```

---

### Get All Orders

**GET** `/api/orders`

---

### Get Order by ID

**GET** `/api/orders/{id}`

---

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

Not deployed yet

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
* ✔ Ready for deployment 🚀
