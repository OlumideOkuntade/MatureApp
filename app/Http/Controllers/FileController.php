<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Vimeo\Laravel\VimeoManager;

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

    //  public function createVideo()
    // {
    //     return view('file.video');
    // }

    //  public function upload(Request $request, VimeoManager $vimeo)
    // {
    //     $request->validate([
    //         'video' => '',
    //         'title'=> 'required',
    //         'description'=> 'required'
    //     ]);
    //     $storedPath = $request->file('video')->store('app','local');
    //     $absolutePath = storage_path('app/' . $storedPath);
    //     if (!file_exists($absolutePath) || !is_readable($absolutePath)) {
    //         throw new \Exception("File not found or unreadable: " . $absolutePath);
    //     }
    //     // dd($absolutePath);
    //     $url = $vimeo->upload($absolutePath ,[
    //         'title'=> $request->title,
    //         'description'=> $request->description,
    //     ]);
    //     dd($url);
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname(), FILE_SKIP_EMPTY_LINES);
        array_shift($fileContents);
        foreach ($fileContents as  $Content) {
            $data = str_getcsv($Content);
            $productName = $data[0] ?? null;
            $price = $data[1] ?? null;
            $qty = $data[2] ?? null;
            $categoryName = $data[3] ?? null;
            $category = Category::firstOrCreate(['name' => $categoryName]);
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

     public function video()
    {
        return view('file.video');
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
