<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Permission=DB::table('permissions')->orderBy('id','DESC')->paginate(10);
        return view('admin.Permission.index',compact('Permission'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

//       $response = Http::get("https://graph.facebook.com/v11.0/me?", [
//         'fields' => 'id,name,photos,posts',
//         'access_token' => 'EAACSboAm4sUBABDusk145ZClOFZCUc57qxSBw1nKC0J6OptmallnnY1lNbJ2gQYR9VZA0gj4xoaiR4kxHRNHFhhdKTmyQACLiLKYsHZALdljRNOPlcZB4XVAiSDVLtwwvhdgL8rY80PgGeXVOKXuxYh6AZChGpBaSFforHogweZAzT3sXuFVQHkbHZA0ZCTTAt4IZD'
//        ]);
//return $response->json();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param PermissionRequest $permissionRequest
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission,Request $request)
    {
    }
}
