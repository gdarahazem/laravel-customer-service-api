<?php

namespace App\Repositories\Interfaces\Service;

use App\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    /**
     * Get all services with pagination
     */
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator;

    /**
     * Get all services
     */
    public function getAll(): Collection;

    /**
     * Find service by ID
     */
    public function findById(int $id): ?Service;

    /**
     * Create new service
     */
    public function create(array $data): Service;

    /**
     * Update service
     */
    public function update(Service $service, array $data): Service;

    /**
     * Delete service
     */
    public function delete(Service $service): bool;

    /**
     * Get services by customer ID
     */
    public function getByCustomerId(int $customerId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Search services
     */
    public function search(string $term, int $perPage = 15): LengthAwarePaginator;

    /**
     * Get services by status
     */
    public function getByStatus(string $status, int $perPage = 15): LengthAwarePaginator;

    /**
     * Get services by type
     */
    public function getByType(string $type, int $perPage = 15): LengthAwarePaginator;
}
