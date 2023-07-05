<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class ProductsController extends Controller
{

    /**
     * Display a listing of the assets.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $products = product::paginate(25);

        $data = $products->transform(function ($product) {
            return $this->transform($product);
        });

        return $this->successResponse(
            'Products were successfully retrieved.',
            $data,
            [
                'links' => [
                    'first' => $products->url(1),
                    'last' => $products->url($products->lastPage()),
                    'prev' => $products->previousPageUrl(),
                    'next' => $products->nextPageUrl(),
                ],
                'meta' =>
                [
                    'current_page' => $products->currentPage(),
                    'from' => $products->firstItem(),
                    'last_page' => $products->lastPage(),
                    'path' => $products->resolveCurrentPath(),
                    'per_page' => $products->perPage(),
                    'to' => $products->lastItem(),
                    'total' => $products->total(),
                ],
            ]
        );
    }

    /**
     * Store a new product in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->getValidator($request);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->all());
            }

            $data = $this->getData($request);
            
            $product = product::create($data);

            return $this->successResponse(
			    'Product was successfully added.',
			    $this->transform($product)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Display the specified product.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::findOrFail($id);

        return $this->successResponse(
		    'Product was successfully retrieved.',
		    $this->transform($product)
		);
    }

    /**
     * Update the specified product in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        try {
            $validator = $this->getValidator($request);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->all());
            }

            $data = $this->getData($request);
            
            $product = product::findOrFail($id);
            $product->update($data);

            return $this->successResponse(
			    'Product was successfully updated.',
			    $this->transform($product)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }

    /**
     * Remove the specified product from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = product::findOrFail($id);
            $product->delete();

            return $this->successResponse(
			    'Product was successfully deleted.',
			    $this->transform($product)
			);
        } catch (Exception $exception) {
            return $this->errorResponse('Unexpected error occurred while trying to process your request.');
        }
    }
    
    /**
     * Gets a new validator instance with the defined rules.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Support\Facades\Validator
     */
    protected function getValidator(Request $request)
    {
        $rules = [
            'productName' => 'required|string|min:1|max:200',
            'productDetail' => 'nullable|string|min:0|max:500',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'quantity' => 'required',
            'imageFile' => 'required|numeric|string|min:1|max:100',
            'typeID' => 'required|string|min:1', 
        ];

        return Validator::make($request->all(), $rules);
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'productName' => 'required|string|min:1|max:200',
            'productDetail' => 'nullable|string|min:0|max:500',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'quantity' => 'required',
            'imageFile' => 'required|numeric|string|min:1|max:100',
            'typeID' => 'required|string|min:1', 
        ];

        
        $data = $request->validate($rules);




        return $data;
    }

    /**
     * Transform the giving product to public friendly array
     *
     * @param App\Models\product $product
     *
     * @return array
     */
    protected function transform(product $product)
    {
        return [
            'productID' => $product->productID,
            'productName' => $product->productName,
            'productDetail' => $product->productDetail,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'imageFile' => $product->imageFile,
            'typeID' => $product->typeID,
        ];
    }


}
