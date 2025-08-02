<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Http\Requests\StoreProductRequest;
use App\Services\ProductManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductResource::collection(Product::all());
         if($products){
            return response()->json([
                'message' => 'successful.',
                'data' => $products
            ]);
        }else{
            return response()->json([
                'message'=>'Failed.',
                'data'=> '422'
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

      public function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'These credentials do not match our records.',
                'data'=> '404'
            ]);
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request, ProductManager $productManager):JsonResponse
    {
        $validated = $request->validated();
        $product = $productManager->createProduct($validated);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $product->addMedia($request->file('image'))->toMediaCollection();
        }
        if($product){
            return response()->json([
                'message' => 'Product created successfully.',
                'data' => $product
            ]);
        }else{
            return response()->json([
                'message'=>'Product failed to add.',
                'data'=> '422'
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = new ProductResource(Product::find($id));
        if($product){
            return response()->json([
                'message' => 'Successful.',
                'data' => $product
            ]);
        }else{
            return response()->json([
                'message'=>'Failed.',
                'data'=> '422'
            ]);
        }
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
