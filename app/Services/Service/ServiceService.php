<?php

namespace App\Services\Service;

use App\Models\Service;
use App\Models\Customer;
use App\Repositories\Interfaces\Service\ServiceRepositoryInterface;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ServiceService
{
    protected ServiceRepositoryInterface $serviceRepository;
    protected CustomerRepositoryInterface $customerRepository;

    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->serviceRepository = $serviceRepository;
        $this->customerRepository = $customerRepository;
    }

    /**
     * Get all services with pagination
     */
    public function getAllServices(int $perPage = 15): LengthAwarePaginator
    {
        return $this->serviceRepository->getAllPaginated($perPage);
    }

    /**
     * Get service by ID
     */
    public function getServiceById(int $id): ?Service
    {
        return $this->serviceRepository->findById($id);
    }

    /**
     * Create new service
     */
    public function createService(array $data): Service
    {
        // Validate customer exists
        $customer = $this->customerRepository->findById($data['customer_id']);
        if (!$customer) {
            throw new \Exception('Customer not found');
        }

        return $this->serviceRepository->create($data);
    }

    /**
     * Update service
     */
    public function updateService(int $id, array $data): Service
    {
        $service = $this->serviceRepository->findById($id);

        if (!$service) {
            throw new \Exception('Service not found');
        }

        // If customer_id is being updated, validate new customer exists
        if (isset($data['customer_id']) && $data['customer_id'] !== $service->customer_id) {
            $customer = $this->customerRepository->findById($data['customer_id']);
            if (!$customer) {
                throw new \Exception('Customer not found');
            }
        }

        return $this->serviceRepository->update($service, $data);
    }

    /**
     * Delete service
     */
    public function deleteService(int $id): bool
    {
        $service = $this->serviceRepository->findById($id);

        if (!$service) {
            throw new \Exception('Service not found');
        }

        return $this->serviceRepository->delete($service);
    }

    /**
     * Get services by customer ID
     */
    public function getServicesByCustomer(int $customerId, int $perPage = 15): LengthAwarePaginator
    {
        // Validate customer exists
        $customer = $this->customerRepository->findById($customerId);
        if (!$customer) {
            throw new \Exception('Customer not found');
        }

        return $this->serviceRepository->getByCustomerId($customerId, $perPage);
    }

    /**
     * Search services
     */
    public function searchServices(string $term, int $perPage = 15): LengthAwarePaginator
    {
        return $this->serviceRepository->search($term, $perPage);
    }

    /**
     * Get services by status
     */
    public function getServicesByStatus(string $status, int $perPage = 15): LengthAwarePaginator
    {
        return $this->serviceRepository->getByStatus($status, $perPage);
    }

    /**
     * Get services by type
     */
    public function getServicesByType(string $type, int $perPage = 15): LengthAwarePaginator
    {
        return $this->serviceRepository->getByType($type, $perPage);
    }
}
