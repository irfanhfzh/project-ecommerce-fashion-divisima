<?php

namespace App\Http\Controllers\admin;

use App\Models\Cash;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index(){
        $data = [
            'title' => 'Product Admin - Laravel Irfan'
        ];  
        
        $search = request()->query('cari');
        if ($search) {
            $products = Product::where('name','LIKE',"%{$search}%")->paginate(10);
        } else {
            $products = Product::latest()->with('category')->paginate(10);
        }

        foreach($products as $productItem){
            if($productItem['qty'] == 0){
                $stockLevel = '<div class="badge badge-danger" style="padding: 5px; font-size: 80%;">Out of Stock</div>';
            } elseif($productItem['qty'] < 4 && $productItem['qty'] > 0) {
                $stockLevel = '<div class="badge badge-warning" style="padding: 5px; font-size: 80%;">Low Stock</div>';
            } else {
                $stockLevel = '<div class="badge badge-success" style="padding: 5px; font-size: 80%;">In Stock</div>';
            }
        }

        // return $productGet;
        return view('admin.product.admin-product', $data, compact('products', 'stockLevel'));
    }

    public function insert(){
        $data = [
            'title' => 'Product Admin - Laravel Irfan'
        ];  

        $categories = Category::get();
        $sizes = Size::get();
        $cashes = Cash::get();

        return view('admin.product.admin-insert-product', $data)
            ->with(compact('categories', 'sizes', 'cashes'));
    }

    public function insertAction(Request $request){
        if($request->submit == "createVariant"){
            $this->validate($request, [
                'category_id' => 'required',
                'code' => 'required|unique:products',
                'name' => 'required|unique:products',
                'description' => 'nullable',
                'size' => 'nullable',
                'cash_id' => 'nullable',
                'variant' => 'nullable',
                'price' => 'nullable',
                'qty' => 'nullable',
                'returns' => 'nullable',
                'delivery' => 'nullable',
                'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // if statement for Upload Image
            if ($request->has('image1')) {
                //get filename with extension
                $filenameWithExt = $request->file('image1')->getClientOriginalName();
                //get filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get extension
                $extension = $request->file('image1')->getClientOriginalExtension();
                //filename to store
                $filenameToStore1 = $filename .'_'.time().'.'. $extension;
                //upload image
                $path = $request->file('image1')->move(public_path('images'), $filenameToStore1);
            } else {
                $filenameToStore1 = 'noimage.jpeg';
            }
            if ($request->has('image2')) {
                //get filename with extension
                $filenameWithExt = $request->file('image2')->getClientOriginalName();
                //get filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get extension
                $extension = $request->file('image2')->getClientOriginalExtension();
                //filename to store
                $filenameToStore2 = $filename .'_'.time().'.'. $extension;
                //upload image
                $path = $request->file('image2')->move(public_path('images'), $filenameToStore2);
            } else {
                $filenameToStore2 = 'noimage.jpeg';
            }
            if ($request->has('image3')) {
                //get filename with extension
                $filenameWithExt = $request->file('image3')->getClientOriginalName();
                //get filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get extension
                $extension = $request->file('image3')->getClientOriginalExtension();
                //filename to store
                $filenameToStore3 = $filename .'_'.time().'.'. $extension;
                //upload image
                $path = $request->file('image3')->move(public_path('images'), $filenameToStore3);
            } else {
                $filenameToStore3 = 'noimage.jpeg';
            }
            if ($request->has('image4')) {
                //get filename with extension
                $filenameWithExt = $request->file('image4')->getClientOriginalName();
                //get filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //get extension
                $extension = $request->file('image4')->getClientOriginalExtension();
                //filename to store
                $filenameToStore4 = $filename .'_'.time().'.'. $extension;
                //upload image
                $path = $request->file('image4')->move(public_path('images'), $filenameToStore4);
            } else {
                $filenameToStore4 = 'noimage.jpeg';
            }
    
            Product::create([
                'category_id' => $request->category_id,
                'code' => $request->code,
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'size' => implode(", ", (array)$request->size),
                'cash_id' => $request->cash_id,
                'variant' => $request->variant,
                'qty' => $request->qty,
                'returns' => $request->returns,
                'delivery' => $request->delivery,
                'description' => $request->description,
                'image1' => $filenameToStore1,
                'image2' => $filenameToStore2,
                'image3' => $filenameToStore3,
                'image4' => $filenameToStore4,
            ]);
    
            return redirect()->route('admin.variant-insert')->with('success','You have successfully Insert Data Product, Now Create Variant for The New Product!');
        }
    }

    public function edit($id){
        $data = [
            'title' => 'Product Admin - Laravel Irfan'
        ];  

        $row = Product::find($id);
        $products = Product::where('id', $id)->get();
        $categories = Category::get();
        $finds = Variant::where('product_id', $id)->first();
        $sizes = Size::get();
        $cashes = Cash::get();
        $getVariant = explode(", ", $finds->variant);
        $arr = $getVariant;

        foreach($products as $productItem){
            if($productItem['qty'] == 0){
                $stockLevel = '<div class="badge badge-danger" style="padding: 5px; font-size: 80%;">Out of Stock</div>';
            } elseif($productItem['qty'] < 4 && $productItem['qty'] > 0) {
                $stockLevel = '<div class="badge badge-warning" style="padding: 5px; font-size: 80%;">Low Stock</div>';
            } else {
                $stockLevel = '<div class="badge badge-success" style="padding: 5px; font-size: 80%;">In Stock</div>';
            }
        }

        // return $variants;
        return view('admin.product.admin-edit-product', $data, ['row'=>$row])
            ->with(compact('categories', 'finds', 'sizes', 'cashes', 'arr', 'stockLevel'));
    }

    public function editAction(Request $request){
        $this->validate($request, [
            'category_id' => 'nullable',
            'name' => 'nullable',
            'description' => 'nullable',
            'size' => 'required',
            'cash_id' => 'nullable',
            'variant' => 'required',
            'price' => 'nullable',
            'qty' => 'nullable',
            'returns' => 'nullable',
            'delivery' => 'nullable',
            'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // if statement for Upload Image
        if ($request->has('image1')) {
            //get filename with extension
            $filenameWithExt = $request->file('image1')->getClientOriginalName();
            //get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get extension
            $extension = $request->file('image1')->getClientOriginalExtension();
            //filename to store
            $filenameToStore1 = $filename .'_'.time().'.'. $extension;
            //upload image
            $path = $request->file('image1')->move(public_path('images'), $filenameToStore1);
            //delete old image
            $product = Product::find($request->id);        
            if ($old = $product->image1){
                Storage::disk('images')->delete("{$old}");
            }
        } else {
            $product = Product::find($request->id);
            $filenameToStore1 = $product->image1;
        }
        if ($request->has('image2')) {
            //get filename with extension
            $filenameWithExt = $request->file('image2')->getClientOriginalName();
            //get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get extension
            $extension = $request->file('image2')->getClientOriginalExtension();
            //filename to store
            $filenameToStore2 = $filename .'_'.time().'.'. $extension;
            //upload image
            $path = $request->file('image2')->move(public_path('images'), $filenameToStore2);
            //delete old image
            $product = Product::find($request->id);        
            if ($old = $product->image2){
                Storage::disk('images')->delete("{$old}");
            }
        } else {
            $product = Product::find($request->id);
            $filenameToStore2 = $product->image2;
        }
        if ($request->has('image3')) {
            //get filename with extension
            $filenameWithExt = $request->file('image3')->getClientOriginalName();
            //get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get extension
            $extension = $request->file('image3')->getClientOriginalExtension();
            //filename to store
            $filenameToStore3 = $filename .'_'.time().'.'. $extension;
            //upload image
            $path = $request->file('image3')->move(public_path('images'), $filenameToStore3);
            //delete old image
            $product = Product::find($request->id);        
            if ($old = $product->image3){
                Storage::disk('images')->delete("{$old}");
            }
        } else {
            $product = Product::find($request->id);
            $filenameToStore3 = $product->image3;
        }
        if ($request->has('image4')) {
            //get filename with extension
            $filenameWithExt = $request->file('image4')->getClientOriginalName();
            //get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //get extension
            $extension = $request->file('image4')->getClientOriginalExtension();
            //filename to store
            $filenameToStore4 = $filename .'_'.time().'.'. $extension;
            //upload image
            $path = $request->file('image4')->move(public_path('images'), $filenameToStore4);
            //delete old image
            $product = Product::find($request->id);        
            if ($old = $product->image4){
                Storage::disk('images')->delete("{$old}");
            }
        } else {
            $product = Product::find($request->id);
            $filenameToStore4 = $product->image4;
        }

        $product = Product::find($request->id);
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->size = implode(", ", (array)$request->size);
        $product->cash_id = $request->cash_id;
        $product->variant = implode(", ", (array)$request->variant);
        $product->qty = $request->qty;
        $product->returns = $request->returns;
        $product->delivery = $request->delivery;
        $product->description = $request->description;
        $product->image1 = $filenameToStore1;
        $product->image2 = $filenameToStore2;
        $product->image3 = $filenameToStore3;
        $product->image4 = $filenameToStore4;
        $product->save();

        return redirect()->route('admin.product')->with('success','You have successfully Edit Data Product!');
    }

    public function delete($id){
        $row = Product::find($id);

        if ($old = $row->image1){
            Storage::disk('images')->delete("{$old}");
        }
        if ($old = $row->image2){
            Storage::disk('images')->delete("{$old}");
        }
        if ($old = $row->image3){
            Storage::disk('images')->delete("{$old}");
        }
        if ($old = $row->image4){
            Storage::disk('images')->delete("{$old}");
        }

        DB::table('wishlists')->where('product_id', $id)->delete();
        DB::table('variants')->where('product_id', $id)->delete();
        DB::table('carts')->where('product_id', $id)->delete();
        DB::table('orders')->where('product_id', $id)->delete();

        $row->delete();

        return redirect()->route('admin.product')->with('delete','You have successfully Delete Data Product!');
    }

    public function indexKategori()
    {
        $data = [
            'title' => 'Category Product Admin - Laravel Irfan'
        ];

        $search = request()->query('cari');
        if ($search) {
            $categories = Category::where('nama','LIKE',"%{$search}%")->paginate(10);
        } else {
            $categories = Category::with('product')->paginate(10);
        }

        return view('admin.product.admin-tambah-kategori', $data, compact('categories'));
    }

    public function tambahKategori()
    {
        $data = [
            'title' => 'Category Product Admin - Laravel Irfan'
        ];

        return view('admin.product.admin-tambah-kategori-insert', $data);
    }

    public function tambahKategoriAction(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:categories',
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori')->with('success','You have successfully Insert Data Category Product!');
    }

    public function editKategori($id)
    {
        $data = [
            'title' => 'Category Product Admin - Laravel Irfan'
        ];

        $categoryId = Category::find($id);

        return view('admin.product.admin-tambah-kategori-edit', $data, ['categoryId'=>$categoryId]);
    }

    public function editKategoriAction(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|unique:categories',
        ]);

        Category::create([
            'nama' => $request->nama,
        ]);

        return redirect()->route('admin.kategori')->with('success','You have successfully Edit Data Category Product!');
    }

    public function deleteKategori($id){
        $row = Category::find($id);

        $row->delete();

        return redirect()->route('admin.kategori')->with('delete','You have successfully Delete Data Kategori Product!');
    }

    public function indexVariant()
    {
        $data = [
            'title' => 'Variant Product Admin - Laravel Irfan'
        ];

        $search = request()->query('cari');
        if ($search) {
            $variants = Variant::where('variant','LIKE',"%{$search}%")->paginate(10);
        } else {
            $variants = Variant::latest()->with('product')->paginate(10);
        }

        return view('admin.product.admin-tambah-variant', $data, compact('variants'));
    }

    public function tambahVariant()
    {
        $data = [
            'title' => 'Variant Product Admin - Laravel Irfan'
        ];

        $products['products'] = Product::get();

        return view('admin.product.admin-tambah-variant-insert', $data, $products);
    }

    public function tambahVariantAction(Request $request)
    {
        $this->validate($request, [
            'variant' => 'required',
            'product_id' => 'required|unique:variants',
        ]);

        Variant::create([
            'variant' => implode(", ", (array)$request->variant),
            'product_id' => $request->product_id,
        ]);

        // $getProductId = Variant::where('product_id', $request->product_id)->first();

        return redirect('/admin/product/edit-product/'.$request->product_id)->with('success','You have successfully Create Variant Product, Now Insert Available Variant for the Product in Here!');
    }

    public function editVariant($id)
    {
        $data = [
            'title' => 'Variant Product Admin - Laravel Irfan'
        ];

        $products = Product::get();

        $getId = $id;
        $finds = Variant::where('id', $id)->first();
        $getVariant = explode(", ", $finds->variant);
        $arr = $getVariant;
        // foreach ($arr as $key => $value) {
        //     echo "key = " . $key . ", value = "
        //         . $value . "\n";
        // }
        // dd($getVariant[0], $getVariant[1]);

        return view('admin.product.admin-tambah-variant-edit', $data, compact('finds', 'products', 'getId', 'getVariant', 'arr'));
    }

    public function editVariantAction(Request $request)
    {
        $this->validate($request, [
            'variant' => 'nullable',
        ]);

        $variants = Variant::find($request->id);
        $variants->variant = implode(", ", (array)$request->variant);
        $variants->product_id = $request->product_id;
        $variants->save();

        return redirect()->route('admin.variant')->with('success','You have successfully Edit Data Variant Product!');
    }

    public function deleteVariant($id){
        $row = Variant::find($id);

        $row->delete();

        return redirect()->route('admin.variant')->with('delete','You have successfully Delete Data Variant Product!');
    }
}
