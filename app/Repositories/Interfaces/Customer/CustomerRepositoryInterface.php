<?php

namespace App\Repositories\Interfaces\Customer;

use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface
{
    /**
     * Get all customers with pagination
     */
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get all customers
     */
    public function getAll(): Collection;

    /**
     * Find customer by ID
     */
    public function findById(int $id): ?Customer;

    /**
     * Create new customer
     */
    public function create(array $data): Customer;

    /**
     * Update customer
     */
    public function update(Customer $customer, array $data): Customer;

    /**
     * Delete customer
     */
    public function delete(Customer $customer): bool;

    /**
     * Find customer by email
     */
    public function findByEmail(string $email): ?Customer;

    /**
     * Search customers
     */
    public function search(string $term, int $perPage = 15): LengthAwarePaginator;
}
