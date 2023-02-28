<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Repositories\CustomerRepository;

use App\Http\Requests\{
    SaveCustomerRequest,
    SearchCustomerRequest
};

use App\Http\Resources\{
    CustomerResource,
    CustomersResource
};

class CustomerController extends Controller
{
    protected $customerRepository;
    
    public function __construct(CustomerRepository $customerRepository){
        $this->customerRepository = $customerRepository;
    }

    public function getCustomers(){
        $customers = $this->customerRepository->getCustomers();
        return response()->json(new CustomersResource($customers));
    }

    public function searchCustomers(SearchCustomerRequest $request){
        $customers = $this->customerRepository->searchCustomers($request);
        return response()->json(new CustomersResource($customers));
    }

    public function createCustomer(SaveCustomerRequest $request){
        $customer = $this->customerRepository->saveCustomer($request);
        return response()->json(new CustomerResource($customer));
    }

    public function updateCustomer(SaveCustomerRequest $request, $customer_id){
        $customer = $this->customerRepository->saveCustomer($request, $customer_id);
        return response()->json(new CustomerResource($customer));
    }

    public function deleteCustomer(int $customer_id){
        return response()->json($this->customerRepository->deleteCustomer($customer_id));
    }

}
