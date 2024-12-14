<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\SupplierRepositoryInterface;
use Validator;
use Throwable;

class SupplierController extends Controller
{

    private $supplierRepository;

    public function __construct(SupplierRepositoryInterface $supplierRepository) {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Register a Supplier.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register() {
        $validator = Validator::make(request()->all(), [
            'nome' => 'required',
            'telefone' => 'required',
            'email' => 'required|email',
            'cep' => 'required',
            'logradouro' => 'required',
            'complemento' => '',
            'bairro' => 'required',
            'estado' => 'required',
            'uf' => 'required',
        ]);
  
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        try{
            $return = $this->supplierRepository->create(request()->all());
            return response()->json($return, 201);

        } catch (Throwable $e) {
            return response()->json(['message' => 'unable to create'], 404);
        }
  
    }

    /**
     * Update a Supplier.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(int $id) {
        $validator = Validator::make(request()->all(), [
            'nome' => 'required',
            'telefone' => 'required',
            'email' => 'required|email',
            'cep' => 'required',
            'logradouro' => 'required',
            'complemento' => '',
            'bairro' => 'required',
            'estado' => 'required',
            'uf' => 'required',
        ]);
  
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        try{
            $return = $this->supplierRepository->update($id, request()->all());
            return response()->json(['message' => 'Successfully updated']);

        } catch (Throwable $e) {
            return response()->json(['message' => 'unable to update'], 404);
        }
  
    }

    /**
     * Get Supplier.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(?int $id = null) {

        $return = $id ? $this->supplierRepository->find($id) : $this->supplierRepository->all();
        return response()->json($return, 200);
    }

    /**
     * Delete Supplier.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(int $id) {

        try{
            
            $this->supplierRepository->delete($id);
            return response()->json(['message' => 'Successfully deleted']);

        } catch (Throwable $e) {
            return response()->json(['message' => 'unable to delete'], 404);
        }
        
    }
}
