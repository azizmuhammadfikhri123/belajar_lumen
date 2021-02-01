<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();

        if ($products == null) {
            $response['status']  = 'failed';
            $response['message'] = 'Tidak dapat menemukan data Product';

            return response()->json($response, 422);
        }

        $response['status']     = 'success';
        $response['data']       = $products;

        return response()->json($response);
    }

    public function create(Request $request) {
        $name        = $request->input('name');
        $price       = $request->input('price');
        $category    = $request->input('category');

        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'price'      => 'required',
            'category'   => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json(
               [
                   'status'     => 'error',
                   'message'    => $validator->errors()->first(),
               ], 422
            );
        }

        if($request->hasFile('photo_product')){
            $resorce                    = $request->file('photo_product');
            $file_name                  = $resorce->getClientOriginalName();
            $request->file('photo_product')
                ->move(public_path("/photo-product/"), $file_name);
            $photoURL = url('/photo-product/'.$file_name);

            $products = Product::create([
                'name'          => $name,
                'price'         => $price,
                'category'      => $category,
                'photo_product' => $photoURL,
            ]);
            
            if ($products == null) {
                $response['status']  = 'failed';
                $response['message'] = 'Tidak dapat menambahkan Product';
    
                return response()->json($response, 422);
            }

            $response['status']         = 'success';
            $response['message']        = 'Berhasil menambahkan Product';

            return response()->json($response);
        }else{
            $response['status']      = 'failed';
            $response['message']     = 'Tidak dapat menambahkan foto';

            return response()->json($response, 422);
        }
    }

    public function update($id, Request $request) {
        $name        = $request->input('name');
        $price       = $request->input('price');
        $category    = $request->input('category');

        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'price'      => 'required',
            'category'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status'     => 'error',
                    'message'    => $validator->errors()->first(),
                ], 422
            );
        }

        $products = Product::where('id', $id)->update([
            'name'          => $name,
            'price'         => $price,
            'category'      => $category,
        ]);

        if ($products == null) {
            $response['status']  = 'failed';
            $response['message'] = 'Tidak dapat mengupdate Product';

            return response()->json($response, 422);
        }

        $response['status']  = 'succes';
        $response['message'] = 'Berhasil mengupdate Product';

        return response()->json($response);
   }

   public function destroy($id) {
        $products = Product::where('id', $id)->delete();

        if ($products == null) {
            $response['status']  = 'failed';
            $response['message'] = 'Tidak dapat mendelete Product';
        }

        $response['status']  = 'succes';
        $response['message'] = 'Berhasil mendelete Product';

        return response()->json($response);
   }
}
