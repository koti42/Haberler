<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));

    }

    public function create()
    {
        return view('admin.category.create');

    }


    public function getAll()
    {
        $categories=Category::all();
        return view('admin.new.create',compact('categories'));

    }


    public function store(Request $request)
    {
        if (strlen($request->slug) > 3) {
            $slug = Str::slug($request->slug);
        } else {
            $slug = Str::slug($request->title);
        }
        if (empty($request->title)) {
            $validate = $request->validate(
                [
                    'title' => 'required|',
                    'slug' => 'required|',
                ]);
        }


        $td = Carbon::now('Europe/Istanbul')->format('Y-m-d H-i');
        $news = Category::insert(
            [
                "title" => $request->title,
                "slug" => $slug, //işlem
                "created_at" => $td,
                "updated_at" => $td,

            ]
        );

        if ($news) {
            return redirect(route('admin.category'))->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }

    public function getCategory($id2)
    {
        $category = Category::find($id2);
        return response()->json($category);

    }


    public function updateCategory(Request $request)
    {


        $cat = Category::findOrFail($request->cat_id);
        $cat->title = $request->cat_name;
        $cat->slug = Str::slug($request->cat_link);
        $cat->save();

        $data = [
            'title' => 'Güncelleme İşlemi Başarılı!',
            'text'  => 'İşlem Tamam 2 Saniye Sonra Bu Ekran Kapanacak',
            'type'  => 'success',
        ];
        return response()->json($data);

    }
    public function deleteCategory(Request $request)
    {
        $deleteCategory=Category::findOrFail($request->delete_id);
        $deleteCategory->delete();
        $data = [
            'title' => 'Silme İşlemi Başarılı!',
            'text'  => 'İşlem Tamam 2 Saniye Sonra Bu Ekran Kapanacak',
            'type'  => 'success',
        ];
        return response()->json($data);

    }

}
