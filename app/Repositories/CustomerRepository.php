<?php
namespace App\Repositories;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerRepository
{
    protected $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function getAll()
    {
        return $this->customer->paginate(30);
    }

    public function countCustomer()
    {
        return $this->customer->count();
    }

    public function create(array $data)
    {
        return $this->customer->create($data);
    }

    public function getByUserName($username)
    {
        return $this->customer->where('username',$username)->first();
    }

    public function getByEmail($email)
    {
        return $this->customer->where('email',$email)->first();
    }
    
    public function getTopCustomersByOrderCount($limit)
    {
        $date =  Carbon::now()->subMonths(3)->startOfDay();
        return $this->customer->select('customers.id', DB::raw('count(orders.id) as order_count'))
            ->join('orders', 'customers.id', '=', 'orders.customer_id')
            ->whereDate('orders.created_at', '>=', $date)
            ->groupBy('customers.id')
            ->orderBy('order_count','desc')
            ->limit($limit)
            ->get();
    }

}