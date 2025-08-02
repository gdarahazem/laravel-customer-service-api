<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Services\Customer\CustomerService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Customer",
 *     type="object",
 *     title="Customer",
 *     description="Customer model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="first_name", type="string", example="John"),
 *     @OA\Property(property="last_name", type="string", example="Doe"),
 *     @OA\Property(property="email", type="string", example="john.doe@example.com"),
 *     @OA\Property(property="phone", type="string", example="+1234567890"),
 *     @OA\Property(property="company", type="string", example="Acme Corp"),
 *     @OA\Property(property="address", type="string", example="123 Main St"),
 *     @OA\Property(property="city", type="string", example="New York"),
 *     @OA\Property(property="state", type="string", example="NY"),
 *     @OA\Property(property="postal_code", type="string", example="10001"),
 *     @OA\Property(property="country", type="string", example="USA"),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z")
 * )
 *
 * @OA\Schema(
 *     schema="CreateCustomerRequest",
 *     type="object",
 *     title="Create Customer Request",
 *     description="Request body for creating a customer",
 *     required={"first_name", "last_name", "email"},
 *     @OA\Property(property="first_name", type="string", example="John", description="Customer's first name"),
 *     @OA\Property(property="last_name", type="string", example="Doe", description="Customer's last name"),
 *     @OA\Property(property="email", type="string", example="john.doe@example.com", description="Customer's email address"),
 *     @OA\Property(property="phone", type="string", example="+1234567890", description="Customer's phone number"),
 *     @OA\Property(property="company", type="string", example="Acme Corp", description="Customer's company"),
 *     @OA\Property(property="address", type="string", example="123 Main St", description="Customer's address"),
 *     @OA\Property(property="city", type="string", example="New York", description="Customer's city"),
 *     @OA\Property(property="state", type="string", example="NY", description="Customer's state"),
 *     @OA\Property(property="postal_code", type="string", example="10001", description="Customer's postal code"),
 *     @OA\Property(property="country", type="string", example="USA", description="Customer's country"),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active", description="Customer's status")
 * )
 *
 * @OA\Schema(
 *     schema="UpdateCustomerRequest",
 *     type="object",
 *     title="Update Customer Request",
 *     description="Request body for updating a customer",
 *     @OA\Property(property="first_name", type="string", example="John", description="Customer's first name"),
 *     @OA\Property(property="last_name", type="string", example="Doe", description="Customer's last name"),
 *     @OA\Property(property="email", type="string", example="john.doe@example.com", description="Customer's email address"),
 *     @OA\Property(property="phone", type="string", example="+1234567890", description="Customer's phone number"),
 *     @OA\Property(property="company", type="string", example="Acme Corp", description="Customer's company"),
 *     @OA\Property(property="address", type="string", example="123 Main St", description="Customer's address"),
 *     @OA\Property(property="city", type="string", example="New York", description="Customer's city"),
 *     @OA\Property(property="state", type="string", example="NY", description="Customer's state"),
 *     @OA\Property(property="postal_code", type="string", example="10001", description="Customer's postal code"),
 *     @OA\Property(property="country", type="string", example="USA", description="Customer's country"),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active", description="Customer's status")
 * )
 */
class CustomerController extends Controller
{
    use ApiResponseTrait;

    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * @OA\Get(
     *     path="/customers",
     *     tags={"Customers"},
     *     summary="Get all customers",
     *     description="Retrieve a paginated list of all customers",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search term",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customers retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Customers retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="total", type="integer"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(ref="#/components/schemas/Customer")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $search = $request->get('search');

            if ($search) {
                $customers = $this->customerService->searchCustomers($search, $perPage);
            } else {
                $customers = $this->customerService->getAllCustomers($perPage);
            }

            return $this->successResponse(
                $customers,
                'Customers retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->serverErrorResponse('Failed to retrieve customers');
        }
    }

    /**
     * @OA\Post(
     *     path="/customers",
     *     tags={"Customers"},
     *     summary="Create a new customer",
     *     description="Create a new customer record",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"first_name", "last_name", "email"},
     *             @OA\Property(property="first_name", type="string", example="John", description="Customer's first name"),
     *             @OA\Property(property="last_name", type="string", example="Doe", description="Customer's last name"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com", description="Customer's email address"),
     *             @OA\Property(property="phone", type="string", example="+1234567890", description="Customer's phone number"),
     *             @OA\Property(property="company", type="string", example="Acme Corp", description="Customer's company"),
     *             @OA\Property(property="address", type="string", example="123 Main St", description="Customer's address"),
     *             @OA\Property(property="city", type="string", example="New York", description="Customer's city"),
     *             @OA\Property(property="state", type="string", example="NY", description="Customer's state"),
     *             @OA\Property(property="postal_code", type="string", example="10001", description="Customer's postal code"),
     *             @OA\Property(property="country", type="string", example="USA", description="Customer's country"),
     *             @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active", description="Customer's status")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Customer created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Customer created successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Customer")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function store(CreateCustomerRequest $request): JsonResponse
    {
        try {
            $customer = $this->customerService->createCustomer($request->validated());

            return $this->successResponse(
                $customer,
                'Customer created successfully',
                201
            );

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Get(
     *     path="/customers/{id}",
     *     tags={"Customers"},
     *     summary="Get a specific customer",
     *     description="Retrieve a specific customer by ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Customer retrieved successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Customer")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Customer not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            $customer = $this->customerService->getCustomerById($id);

            if (!$customer) {
                return $this->notFoundResponse('Customer not found');
            }

            return $this->successResponse(
                $customer,
                'Customer retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->serverErrorResponse('Failed to retrieve customer');
        }
    }

    /**
     * @OA\Put(
     *     path="/customers/{id}",
     *     tags={"Customers"},
     *     summary="Update a customer",
     *     description="Update a specific customer by ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="first_name", type="string", example="John", description="Customer's first name"),
     *             @OA\Property(property="last_name", type="string", example="Doe", description="Customer's last name"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com", description="Customer's email address"),
     *             @OA\Property(property="phone", type="string", example="+1234567890", description="Customer's phone number"),
     *             @OA\Property(property="company", type="string", example="Acme Corp", description="Customer's company"),
     *             @OA\Property(property="address", type="string", example="123 Main St", description="Customer's address"),
     *             @OA\Property(property="city", type="string", example="New York", description="Customer's city"),
     *             @OA\Property(property="state", type="string", example="NY", description="Customer's state"),
     *             @OA\Property(property="postal_code", type="string", example="10001", description="Customer's postal code"),
     *             @OA\Property(property="country", type="string", example="USA", description="Customer's country"),
     *             @OA\Property(property="status", type="string", enum={"active", "inactive"}, example="active", description="Customer's status")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Customer updated successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Customer")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Customer not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function update(UpdateCustomerRequest $request, int $id): JsonResponse
    {
        try {
            $customer = $this->customerService->updateCustomer($id, $request->validated());

            return $this->successResponse(
                $customer,
                'Customer updated successfully'
            );

        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'not found')) {
                return $this->notFoundResponse($e->getMessage());
            }
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Delete(
     *     path="/customers/{id}",
     *     tags={"Customers"},
     *     summary="Delete a customer",
     *     description="Delete a specific customer by ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Customer deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Customer not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->customerService->deleteCustomer($id);

            return $this->successResponse(
                null,
                'Customer deleted successfully'
            );

        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'not found')) {
                return $this->notFoundResponse($e->getMessage());
            }
            return $this->serverErrorResponse('Failed to delete customer');
        }
    }
}

