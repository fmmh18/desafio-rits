<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\OrderModel;
use App\Model\ClientModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailClientOrder;

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
                $client = ClientModel::findOrfail($input->client_id);
                Mail::to($client->email)->queue(new SendMailClientOrder($client));
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
            $client = ClientModel::findOrfail($input->client_id);
            $data = OrderModel::where('client_id',$data->id)-first();
            Mail::to($client->email)->queue(new SendMailClientOrder($data));
             return $order->update($input); 
        }
    }

    public function destroy($id)
    {
        $order =  OrderModel::findOrfail($id);
        return $order->delete(); 
    }
}
