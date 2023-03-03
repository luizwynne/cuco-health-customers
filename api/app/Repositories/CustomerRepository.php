<?php 

namespace App\Repositories;

use App\Models\Customer;

use App\Http\Requests\{
    SaveCustomerRequest,
    SearchCustomerRequest
};

class CustomerRepository{

    public function getCustomers(){
        return Customer::all();
    }

    public function searchCustomers($request){

        $customers = Customer::where(function($q) use($request) {
            $q->where('name', 'like', '%'.$request->params.'%')
              ->orWhere('cpf', 'like', '%'.$request->params.'%');
        })->orderBy('nome', 'ASC')->get();
       
        return $customers;

    }

    public function getCustomer($customer_id){
        return Customer::findOrFail($customer_id);
    }

    public function saveCustomer($customerObj, $customer_id = null){

        $customer = empty($customer_id) ? new Customer : Customer::findOrFail($customer_id);

        if(!$customer){
            return null;
        }

        try{

            $customer->name = $customerObj->name;

            if(empty($customer_id)){
                $customer->cpf = $customerObj->cpf;
            }
            
            $customer->birthdate = $customerObj->birthdate;
            $customer->phone_number = $customerObj->phone_number;
            $customer->save();

            return $customer;

        }catch(\Exception $e){
            return $e;
        }

    }

    public function deleteCustomer(int $customer_id)
    {
        Customer::findOrFail($customer_id)->delete();
        return true;
    }

}