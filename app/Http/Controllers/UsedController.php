<?php

namespace Closet\Http\Controllers;

use Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Closet\Jobs\Product\UsedUpload;
use Closet\Jobs\Images\DeleteImage;
use Closet\Models\{UsedProduct,UsedProductImage};

class UsedController extends Controller
{
    public function show(UsedProduct $product)
    {
        return view('product.show_used', ['product' => $product]);
    }

    public function create()
    {
      return view('product.sell_used');
    }

    public function userProduct(Request $request)
    {
      $products = $request->user()->used()->latestFirst()->paginate(10);

      return view('product.myproduct_used', ['products' => $products]);
    }

    public function store(Request $request,UsedProduct $product,UsedProductImage $productimage)
    {
      $type_id = !$request->type_id ? $request->type_id : 1;
      $uid = uniqid('p_used');
      $shop = $request->user()->shop()->first();
      $product = $shop->used()->create([
        'uid' => $uid,
        'name' => $request->name,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id,
        'type_id' => $type_id,
        'price' => $request->price,
        'description' => $request->description,
        'thumbnail' => '',
      ]);

      $images =  $request->file('image');
      if($images[0]) {
        $thumbnail = uniqid('p_thumb_2_').$request->user()->id;
        Storage::disk('uploads')->putFileAs('used/thumbnail/', $images[0], $thumbnail);
      }
      foreach ($images as $image) {
        $photo = uniqid('p_img_2_').$request->user()->id;
        Storage::disk('uploads')->putFileAs('used/photo/', $image, $photo);
        $photos[] = $photo;
      }

      $this->dispatch(new UsedUpload($product, $thumbnail, $photos));
      return response()->json();
    }

    public function delete(UsedProduct $product)
    {
        $path = 'used/thumbnail/' . $product->thumbnail;
        $this->dispatch(new DeleteImage($path));
      foreach ($product->productimages as $image) {
        $path = 'used/photo/' . $image->filename;
        $this->dispatch(new DeleteImage($path));
      }
      $product->delete();

      return redirect()->back();
    }
}
