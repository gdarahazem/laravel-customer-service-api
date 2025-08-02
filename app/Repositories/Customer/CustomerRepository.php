<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function getAllPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return Customer::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function getAll(): Collection
    {
        return Customer::orderBy('created_at', 'desc')->get();
    }

    public function findById(int $id): ?Customer
    {
        return Customer::find($id);
    }

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function update(Customer $customer, array $data): Customer
    {
        $customer->update($data);
        return $customer->fresh();
    }

    public function delete(Customer $customer): bool
    {
        return $customer->delete();
    }

    public function findByEmail(string $email): ?Customer
    {
        return Customer::where('email', $email)->first();
    }

    public function search(string $term, int $perPage = 15): LengthAwarePaginator
    {
        return Customer::where(function ($query) use ($term) {
            $query->where('first_name', 'like', "%{$term}%")
                ->orWhere('last_name', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")
                ->orWhere('company', 'like', "%{$term}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
