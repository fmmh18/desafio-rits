<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProductModel;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        ProductModel::all();
    }

    public function store(Request $request)
    {
        
        $input = $request->all();
        $messages = [
            'required' => 'O campo :attribute é obrigatório.'
        ];

        $rules = [ 
            'name' => 'required',
            'price' => 'required'
        ];
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        { 
            try{
                return ProductModel::create($input);
            }catch (\Exception $e){
                    return $e->getCode();
            }
        }

    }

    public function show($id)
    {
        return ProductModel::findOrfail($id);
    }


    public function update(Request $request, $id)
    {
        $product = ProductModel::findOrfail($id);
        $input = $request->all();
        $messages = [
            'required' => 'O campo :attribute é obrigatório.'
        ];

        $rules = [ 
            'name' => 'required',
            'price' => 'required'
        ];
        $validatedData = Validator::make($input,$rules, $messages);
       
        if($validatedData->fails())
        {
            return $validatedData->messages();
        }
        else
        { 
            return $product->update($input);
        }
    }

    public function destroy($id)
    {
        $product = ProductModel::findOrfail($id);
        return $product->delete();
    }
}
