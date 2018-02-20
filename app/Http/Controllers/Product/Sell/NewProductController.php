<?php

namespace Closet\Http\Controllers\Product\Sell;

use Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Closet\Jobs\Product\ProductUpload;
use Closet\Http\Controllers\Controller;
use Closet\Models\{Product,ProductImage};

class NewProductController extends Controller
{
  public function index(Request $request)
  {
    if ($request->user()->canSell()) {
      return view('product.sell');
    } else {
      return view('product.cant_sell', ['shop' => $request->user()->shop]);
    }
  }

  public function create(Request $request, Product $product, ProductImage $productimage)
  {
    $type_id = $request->type_id == 'null' ? '1' : $request->type_id;
    $uid = uniqid('p_');
    $shop = $request->user()->shop()->first();
    $product = $shop->product()->create([
      'uid' => $uid,
      'name' => $request->name,
      'category_id' => $request->category_id,
      'subcategory_id' => $request->subcategory_id,
      'type_id' => $type_id,
      'price' => $request->price,
      'description' => $request->description,
      'visibility' => $request->visibility,
      'thumbnail' => '',
    ]);

    $images =  $request->file('image');
    if($images[0]) {
      $thumbnail = uniqid('p_thumb_').$request->user()->id;
      Storage::disk('uploads')->putFileAs('product/thumbnail/', $images[0], $thumbnail);
    }
    foreach ($images as $image) {
      $photo = uniqid('p_img_').$request->user()->id;
      Storage::disk('uploads')->putFileAs('product/photo/', $image, $photo);
      $photos[] = $photo;
    }

    $this->dispatch(new ProductUpload($product, $thumbnail, $photos));

    return response()->json();
  }

}