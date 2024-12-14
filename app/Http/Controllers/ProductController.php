<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use Validator;
use Throwable;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    /**
     * Register a Product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register() {
        $validator = Validator::make(request()->all(), [
            'codigo' => 'required',
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required',
            'categoria' => 'required',
            'quantidade' => 'required',
            'fornecedor_id' => 'required',
        ]);
  
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        try{
            $return = $this->productRepository->create(request()->all());
            return response()->json($return, 201);

        } catch (Throwable $e) {
            return response()->json(['message' => 'unable to create'], 404);
        }
  
    }

    /**
     * Update a Product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id) {
        $validator = Validator::make(request()->all(), [
            'codigo' => 'required',
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required',
            'categoria' => 'required',
            'quantidade' => 'required',
            'fornecedor_id' => 'required',
        ]);
  
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        try{
            $return = $this->productRepository->update($id, request()->all());
            return response()->json(['message' => 'Successfully updated']);

        } catch (Throwable $e) {
            return response()->json(['message' => 'unable to update'], 404);
        }
  
    }

    /**
     * Get Product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(?int $id = null) {

        $return = $id ? $this->productRepository->find($id) : $this->productRepository->all();
  
        return response()->json($return, 200);
    }
    
    /**
     * Delete Product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id) {

        try{

            $this->productRepository->delete($id);
            return response()->json(['message' => 'Successfully deleted']);

        } catch (Throwable $e) {
            return response()->json(['message' => 'unable to delete'], 404);
        }
        
    }
}
