<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderModel;

class OrderController extends Controller
{
    public function index()
    {
        return OrderModel::all();
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $messages = [
            'required' => 'O campo :attribute é obrigatório.'
        ];

        $rules = [ 
            'id_product' => 'required',
            'id_client' => 'required'
        ];
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        { 
            try{
                return OrderModel::create($input);
            }catch (\Exception $e){
                    return $e->getCode();
            }
        }
    }

    public function show($id)
    {
        return OrderModel::findOrfail($id);
    }


    public function update(Request $request, $id)
    {
        $order =  OrderModel::findOrfail($id);
        $input = $request->all();
        $messages = [
            'required' => 'O campo :attribute é obrigatório.'
        ];

        $rules = [ 
            'id_product' => 'required',
            'id_client' => 'required'
        ];
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
             return $order->update($input); 
        }
    }

    public function destroy($id)
    {
        $order =  OrderModel::findOrfail($id);
        return $order->delete(); 
    }
}
