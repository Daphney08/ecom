<?php

namespace App\Http\Controllers;
use App\Models\Products;

use Illuminate\Http\Request;


class IndexController extends Controller
{
    protected $request;
    //declare varialble
    public function __construct(Request $request)
    {
        //make the request available on the class
        $this->request = $request;
    }
    public function index()
    {
        $data = Products::all(); 
        if($this->request->has('search')){
            $data = Products::where(
                $this->request->by,
                'LIKE',  
                '%'.$this->request->search.'%'
            )->get(); 

        }
        /**
         * kinds of operator
         * = != < > <= >+ LIKE
         * 
         * ->where(column_name, operator, string)
         */

        if($this->request->has('price1')){
            $data = Products::where('price','>=', $this->request->price1)
                            ->where('price','<=', $this->request->price2)
                            ->get();

        }
        
        
        return view('index')->with([
            'data' => $data
        ]);
    }
}
