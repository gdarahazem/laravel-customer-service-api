<?php

namespace App\Http\Controllers\Api\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Services\Service\ServiceService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Service",
 *     type="object",
 *     title="Service",
 *     description="Service model",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="customer_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Web Development"),
 *     @OA\Property(property="description", type="string", example="Complete website development with modern technologies"),
 *     @OA\Property(property="type", type="string", enum={"consultation", "development", "maintenance", "support", "training", "other"}, example="development"),
 *     @OA\Property(property="price", type="number", format="float", example=2500.00),
 *     @OA\Property(property="status", type="string", enum={"active", "inactive", "pending", "completed"}, example="active"),
 *     @OA\Property(property="start_date", type="string", format="date", example="2024-02-01"),
 *     @OA\Property(property="end_date", type="string", format="date", example="2024-03-15"),
 *     @OA\Property(property="duration_hours", type="integer", example=120),
 *     @OA\Property(property="features", type="array", @OA\Items(type="string"), example={"Responsive Design", "SEO Optimization", "Admin Panel"}),
 *     @OA\Property(property="notes", type="string", example="Client requires mobile-first approach"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-01T00:00:00.000000Z"),
 *     @OA\Property(
 *         property="customer",
 *         type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="first_name", type="string", example="John"),
 *         @OA\Property(property="last_name", type="string", example="Doe"),
 *         @OA\Property(property="email", type="string", example="john.doe@example.com"),
 *         @OA\Property(property="company", type="string", example="Acme Corp")
 *     )
 * )
 */
class ServiceController extends Controller
{
    use ApiResponseTrait;

    protected ServiceService $serviceService;

    public function __construct(ServiceService $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * @OA\Get(
     *     path="/services",
     *     tags={"Services"},
     *     summary="Get all services",
     *     description="Retrieve a paginated list of all services",
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
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by status",
     *         required=false,
     *         @OA\Schema(type="string", enum={"active", "inactive", "pending", "completed"})
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filter by type",
     *         required=false,
     *         @OA\Schema(type="string", enum={"consultation", "development", "maintenance", "support", "training", "other"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Services retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Services retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="total", type="integer"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(ref="#/components/schemas/Service")
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
            $status = $request->get('status');
            $type = $request->get('type');

            if ($search) {
                $services = $this->serviceService->searchServices($search, $perPage);
            } elseif ($status) {
                $services = $this->serviceService->getServicesByStatus($status, $perPage);
            } elseif ($type) {
                $services = $this->serviceService->getServicesByType($type, $perPage);
            } else {
                $services = $this->serviceService->getAllServices($perPage);
            }

            return $this->successResponse(
                $services,
                'Services retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->serverErrorResponse('Failed to retrieve services');
        }
    }

    /**
     * @OA\Post(
     *     path="/services",
     *     tags={"Services"},
     *     summary="Create a new service",
     *     description="Create a new service for a customer",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"customer_id", "name", "type", "price"},
     *             @OA\Property(property="customer_id", type="integer", example=1, description="Customer ID"),
     *             @OA\Property(property="name", type="string", example="Web Development", description="Service name"),
     *             @OA\Property(property="description", type="string", example="Complete website development", description="Service description"),
     *             @OA\Property(property="type", type="string", enum={"consultation", "development", "maintenance", "support", "training", "other"}, example="development", description="Service type"),
     *             @OA\Property(property="price", type="number", format="float", example=2500.00, description="Service price"),
     *             @OA\Property(property="status", type="string", enum={"active", "inactive", "pending", "completed"}, example="active", description="Service status"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2024-02-01", description="Start date"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-03-15", description="End date"),
     *             @OA\Property(property="duration_hours", type="integer", example=120, description="Duration in hours"),
     *             @OA\Property(property="features", type="array", @OA\Items(type="string"), example={"Responsive Design", "SEO"}, description="Service features"),
     *             @OA\Property(property="notes", type="string", example="Special requirements", description="Additional notes")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Service created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Service created successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Service")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function store(CreateServiceRequest $request): JsonResponse
    {
        try {
            $service = $this->serviceService->createService($request->validated());

            return $this->successResponse(
                $service->load('customer'),
                'Service created successfully',
                201
            );

        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 400);
        }
    }

    /**
     * @OA\Get(
     *     path="/services/{id}",
     *     tags={"Services"},
     *     summary="Get a specific service",
     *     description="Retrieve a specific service by ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Service ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Service retrieved successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Service")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Service not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            $service = $this->serviceService->getServiceById($id);

            if (!$service) {
                return $this->notFoundResponse('Service not found');
            }

            return $this->successResponse(
                $service,
                'Service retrieved successfully'
            );

        } catch (\Exception $e) {
            return $this->serverErrorResponse('Failed to retrieve service');
        }
    }

    /**
     * @OA\Put(
     *     path="/services/{id}",
     *     tags={"Services"},
     *     summary="Update a service",
     *     description="Update a specific service by ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Service ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="customer_id", type="integer", example=1, description="Customer ID"),
     *             @OA\Property(property="name", type="string", example="Web Development", description="Service name"),
     *             @OA\Property(property="description", type="string", example="Complete website development", description="Service description"),
     *             @OA\Property(property="type", type="string", enum={"consultation", "development", "maintenance", "support", "training", "other"}, example="development", description="Service type"),
     *             @OA\Property(property="price", type="number", format="float", example=2500.00, description="Service price"),
     *             @OA\Property(property="status", type="string", enum={"active", "inactive", "pending", "completed"}, example="active", description="Service status"),
     *             @OA\Property(property="start_date", type="string", format="date", example="2024-02-01", description="Start date"),
     *             @OA\Property(property="end_date", type="string", format="date", example="2024-03-15", description="End date"),
     *             @OA\Property(property="duration_hours", type="integer", example=120, description="Duration in hours"),
     *             @OA\Property(property="features", type="array", @OA\Items(type="string"), example={"Responsive Design", "SEO"}, description="Service features"),
     *             @OA\Property(property="notes", type="string", example="Special requirements", description="Additional notes")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Service updated successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Service")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Service not found"),
     *     @OA\Response(response=422, description="Validation error"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function update(UpdateServiceRequest $request, int $id): JsonResponse
    {
        try {
            $service = $this->serviceService->updateService($id, $request->validated());

            return $this->successResponse(
                $service,
                'Service updated successfully'
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
     *     path="/services/{id}",
     *     tags={"Services"},
     *     summary="Delete a service",
     *     description="Delete a specific service by ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Service ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Service deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Service deleted successfully")
     *         )
     *     ),
     *     @OA\Response(response=404, description="Service not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->serviceService->deleteService($id);

            return $this->successResponse(
                null,
                'Service deleted successfully'
            );

        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'not found')) {
                return $this->notFoundResponse($e->getMessage());
            }
            return $this->serverErrorResponse('Failed to delete service');
        }
    }

    /**
     * @OA\Get(
     *     path="/customers/{customerId}/services",
     *     tags={"Services"},
     *     summary="Get services by customer",
     *     description="Retrieve all services for a specific customer",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="customerId",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
     *     @OA\Response(
     *         response=200,
     *         description="Customer services retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Customer services retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="object",
     *                 @OA\Property(property="current_page", type="integer"),
     *                 @OA\Property(property="total", type="integer"),
     *                 @OA\Property(property="per_page", type="integer"),
     *                 @OA\Property(
     *                     property="data",
     *                     type="array",
     *                     @OA\Items(ref="#/components/schemas/Service")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=404, description="Customer not found"),
     *     @OA\Response(response=401, description="Unauthenticated")
     * )
     */
    public function getByCustomer(Request $request, int $customerId): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);

            $services = $this->serviceService->getServicesByCustomer($customerId, $perPage);

            return $this->successResponse(
                $services,
                'Customer services retrieved successfully'
            );

        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'Customer not found')) {
                return $this->notFoundResponse($e->getMessage());
            }
            return $this->serverErrorResponse('Failed to retrieve customer services');
        }
    }
}
