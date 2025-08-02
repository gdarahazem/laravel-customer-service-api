<?php

namespace App\Repositories\Service;

use App\Models\Service;
use App\Repositories\Interfaces\Service\ServiceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return Service::with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getAll(): Collection
    {
        return Service::with('customer')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findById(int $id): ?Service
    {
        return Service::with('customer')->find($id);
    }

    public function create(array $data): Service
    {
        return Service::create($data);
    }

    public function update(Service $service, array $data): Service
    {
        $service->update($data);
        return $service->fresh(['customer']);
    }

    public function delete(Service $service): bool
    {
        return $service->delete();
    }

    public function getByCustomerId(int $customerId, int $perPage = 15): LengthAwarePaginator
    {
        return Service::with('customer')
            ->where('customer_id', $customerId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function search(string $term, int $perPage = 15): LengthAwarePaginator
    {
        return Service::with('customer')
            ->where(function ($query) use ($term) {
                $query->where('name', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%")
                    ->orWhere('type', 'like', "%{$term}%")
                    ->orWhereHas('customer', function ($customerQuery) use ($term) {
                        $customerQuery->where('first_name', 'like', "%{$term}%")
                            ->orWhere('last_name', 'like', "%{$term}%")
                            ->orWhere('company', 'like', "%{$term}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getByStatus(string $status, int $perPage = 15): LengthAwarePaginator
    {
        return Service::with('customer')
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getByType(string $type, int $perPage = 15): LengthAwarePaginator
    {
        return Service::with('customer')
            ->where('type', $type)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
