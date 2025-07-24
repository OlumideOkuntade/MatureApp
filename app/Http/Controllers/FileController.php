<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.file_upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());
        $header = null;
        foreach ($fileContents as  $Content) {
            if (!$header) {
                $header = true;
                continue;
            }
            $data = str_getcsv($Content);
            $productName = $data[0] ?? null;
            $price = $data[1] ?? null;
            $qty = $data[2] ?? null;
            $categoryName = $data[3] ?? null;
            $category = Category::firstOrCreate(['name' => $categoryName]);
            // Create the product with category_id
            Product::create([
                'name'        => $productName,
                'price'       => $price,
                'quantity'  => $qty,
                'category_id' => $category->id,
                'status'=> 'active',
                'image'=>''
            ]);
        }
        return redirect('/upload/file')->with('success', 'data stored successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
