# Laravel Customer Service API

A comprehensive RESTful API for managing customers and their services, built with Laravel and featuring complete CRUD operations, authentication, and professional architecture patterns.

## 🚀 Features

### Authentication System
- ✅ User registration and login
- ✅ JWT token-based authentication with Laravel Sanctum
- ✅ Secure logout functionality
- ✅ Protected API endpoints

### Customer Management
- ✅ Create, read, update, and delete customers
- ✅ Customer search functionality
- ✅ Pagination support
- ✅ Email uniqueness validation
- ✅ Comprehensive customer profiles

### Service Management
- ✅ Create services for customers
- ✅ View all services with filtering
- ✅ View services by customer
- ✅ Update and delete services
- ✅ Service type categorization
- ✅ Status tracking (active, inactive, pending, completed)
- ✅ Price management and duration tracking

### Technical Features
- ✅ Repository Pattern with Interfaces
- ✅ Service Layer Architecture
- ✅ Comprehensive Request Validation
- ✅ Swagger/OpenAPI Documentation
- ✅ Database Factories and Seeders
- ✅ Professional Error Handling
- ✅ Standardized API Responses

## 🛠 Technologies Used

- **Backend Framework:** Laravel 12.x
- **Authentication:** Laravel Sanctum
- **Database:** MySQL/SQL Server (configurable)
- **Documentation:** Swagger/OpenAPI (L5-Swagger)
- **PHP Version:** 8.2+
- **Architecture:** Repository Pattern, Service Layer

## 📋 Requirements

- PHP >= 8.2
- Composer
- MySQL/SQL Server
- Node.js (for frontend assets, optional)

## 🔧 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/laravel-customer-service-api.git
cd laravel-customer-service-api
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
Edit your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_customer_service_api
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Setup

#### Option A: Using Migrations and Seeders (Recommended)
```bash
# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed

# Or run specific seeders
php artisan db:seed --class=CustomerSeeder
php artisan db:seed --class=ServiceSeeder
```

#### Option B: Using SQL File
If you prefer not to use migrations and seeders, you can import the provided SQL file:
```bash
# Import the database structure and sample data
mysql -u your_username -p your_database_name < database/laravel-customer-service-api.sql
```
*Note: The `laravel-customer-service-api.sql` file is located in the `database` folder and contains the complete database structure with sample data.*

### 6. Generate Swagger Documentation
```bash
php artisan l5-swagger:generate
```

### 7. Start the Development Server
```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## 📚 API Documentation

### Swagger Documentation
Access the interactive API documentation at:
```
http://localhost:8000/api/documentation
```

The Swagger documentation provides:
- Complete API endpoint listings
- Request/response examples
- Interactive testing interface
- Authentication requirements
- Data model schemas

### Base URL
```
http://localhost:8000/api
```

### Authentication
All endpoints (except registration and login) require authentication using Bearer tokens:
```
Authorization: Bearer your-jwt-token
```

## 🧪 Testing with Postman

### Postman Collection
A complete Postman collection is included in the project:
```
Laravel Customer Service API.postman_collection.json
```

### Setup Instructions
1. **Import Collection:**
   - Open Postman
   - Click "Import" → "Choose Files"
   - Select `Laravel Customer Service API.postman_collection.json`

2. **Create Environment:**
   ⚠️ **Important:** You must create and configure an environment for the collection to work properly.
   
   - Click the gear icon → "Manage Environments"
   - Click "Add" to create a new environment
   - Add these variables:
   ```
   base_url: http://localhost:8000/api
   auth_token: (leave empty - will be auto-filled)
   customer_id: (leave empty - will be auto-filled)
   service_id: (leave empty - will be auto-filled)
   ```
   - Select this environment in the top-right dropdown

3. **Testing Workflow:**
   ```
   1. Register User
   2. Login User (token auto-saved)
   3. Create Customer (ID auto-saved)
   4. Create Service (ID auto-saved)
   5. Test all CRUD operations
   ```

## 🗂 API Endpoints

### Authentication
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/auth/register` | Register new user |
| POST | `/auth/login` | Login user |
| POST | `/auth/logout` | Logout user |

### Customers
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/customers` | Get all customers (with pagination & search) |
| POST | `/customers` | Create new customer |
| GET | `/customers/{id}` | Get customer by ID |
| PUT | `/customers/{id}` | Update customer |
| DELETE | `/customers/{id}` | Delete customer |

### Services
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/services` | Get all services (with pagination & filters) |
| POST | `/services` | Create new service |
| GET | `/services/{id}` | Get service by ID |
| PUT | `/services/{id}` | Update service |
| DELETE | `/services/{id}` | Delete service |
| GET | `/customers/{id}/services` | Get services by customer |

### Query Parameters
- `page` - Page number for pagination
- `per_page` - Items per page (default: 15)
- `search` - Search term for filtering
- `status` - Filter services by status
- `type` - Filter services by type

## 📊 Database Schema

### Customers Table
- `id` - Primary key
- `first_name` - Customer's first name
- `last_name` - Customer's last name
- `email` - Unique email address
- `phone` - Phone number
- `company` - Company name
- `address` - Street address
- `city` - City
- `state` - State/Province
- `postal_code` - Postal/ZIP code
- `country` - Country
- `status` - active/inactive
- `timestamps` - Created/updated timestamps

### Services Table
- `id` - Primary key
- `customer_id` - Foreign key to customers
- `name` - Service name
- `description` - Service description
- `type` - consultation/development/maintenance/support/training/other
- `price` - Service price (decimal)
- `status` - active/inactive/pending/completed
- `start_date` - Service start date
- `end_date` - Service end date
- `duration_hours` - Duration in hours
- `features` - JSON array of features
- `notes` - Additional notes
- `timestamps` - Created/updated timestamps

## 🏗 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Api/
│   │       ├── AuthController.php
│   │       ├── Customer/
│   │       │   └── CustomerController.php
│   │       └── Service/
│   │           └── ServiceController.php
│   └── Requests/
│       ├── Auth/
│       ├── Customer/
│       └── Service/
├── Models/
│   ├── Customer.php
│   ├── Service.php
│   └── User.php
├── Repositories/
│   ├── Interfaces/
│   │   ├── Customer/
│   │   └── Service/
│   ├── Customer/
│   └── Service/
├── Services/
│   ├── Auth/
│   ├── Customer/
│   └── Service/
├── Traits/
│   └── ApiResponseTrait.php
└── Providers/
    └── RepositoryServiceProvider.php

database/
├── factories/
├── migrations/
├── seeders/
└── laravel-customer-service-api.sql
```
