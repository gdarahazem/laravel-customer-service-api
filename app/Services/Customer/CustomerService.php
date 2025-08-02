<?php

namespace App\Services\Customer;

use App\Models\Customer;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    protected CustomerRepositoryInterface $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Get all customers with pagination
     */
    public function getAllCustomers(int $perPage = 15): LengthAwarePaginator
    {
        return $this->customerRepository->getAllPaginated($perPage);
    }

    /**
     * Get customer by ID
     */
    public function getCustomerById(int $id): ?Customer
    {
        return $this->customerRepository->findById($id);
    }

    /**
     * Create new customer
     */
    public function createCustomer(array $data): Customer
    {
        // Check if email already exists
        if ($this->customerRepository->findByEmail($data['email'])) {
            throw new \Exception('Customer with this email already exists');
        }

        return $this->customerRepository->create($data);
    }

    /**
     * Update customer
     */
    public function updateCustomer(int $id, array $data): Customer
    {
        $customer = $this->customerRepository->findById($id);

        if (!$customer) {
            throw new \Exception('Customer not found');
        }

        // Check if email already exists for other customers
        if (isset($data['email'])) {
            $existingCustomer = $this->customerRepository->findByEmail($data['email']);
            if ($existingCustomer && $existingCustomer->id !== $customer->id) {
                throw new \Exception('Customer with this email already exists');
            }
        }

        return $this->customerRepository->update($customer, $data);
    }

    /**
     * Delete customer
     */
    public function deleteCustomer(int $id): bool
    {
        $customer = $this->customerRepository->findById($id);

        if (!$customer) {
            throw new \Exception('Customer not found');
        }

        return $this->customerRepository->delete($customer);
    }

    /**
     * Search customers
     */
    public function searchCustomers(string $term, int $perPage = 15): LengthAwarePaginator
    {
        return $this->customerRepository->search($term, $perPage);
    }
}
