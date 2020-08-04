<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Model\clientModel;

class ClientController extends Controller
{
    public function index()
    {
        return clientModel::all();
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $messages = [
            'required' => 'O campo :attribute é obrigatório.'
        ];

        $rules = [ 
            'name' => 'required',
            'mail' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ];
        $validatedData = Validator::make($input,$rules, $messages);
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        { 
            try{
                return clientModel::create($input);
            }catch (\Exception $e){
                    return $e->getCode();
            }
        }
    }

    public function show($id)
    {
         return clientModel::findOrfail($id);
    }


    public function update(Request $request, $id)
    {
        $client = clientModel::findOrfail($id);
        $input = $request->all();
        $messages = [
            'required' => 'O campo :attribute é obrigatório.'
        ];

        $rules = [ 
            'name' => 'required',
            'mail' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ];
        $validatedData = Validator::make($input,$rules, $messages);
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        {
        return $filme->update($input);
        }

    }

    public function destroy($id)
    {
        $client = clientModel::findOrfail($id);
        return $client->delete();
    }
}
