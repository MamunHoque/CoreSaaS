<?php

namespace App\Http\Controllers;

use App\Helper\Format;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $this->authorize('viewAny', Permission::class);

        return $this->view('browse');
    }

    /**
     * Parse All Permission data with DataTable
     *
     * @return api
     */
    public function browse()
    {

        return datatables()->of(Permission::query())
            ->addColumn('action', function(Permission $permission) {
                $action = '<a href = "'.route('permissions.edit', $permission->id).'" class="btn btn-sm btn-success">edit</a>';
                return $action;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Permission::class);

        return $this->view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $permission = new Permission();
            $permission->name = Format::toSingle($request->name);
            $permission->label = $request->label ?: Format::label($request->name);

            if ($request->table_name){
                $permission->table_name = $request->table_name;
            }

            $permission->save();

            return \redirect()->route('permissions.index')
                ->with('success', __("common.new_permission_has_been_stored_successfully."));
        } catch (\Throwable $th) {
            return \redirect()->route('permissions.index')
                ->with('error', __('common.permission_is_not_being_stored._please,_try_again.'));
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
        $permission = Permission::find($id);

        $this->authorize('update', $permission);

        if (empty($permission)) {
            return \redirect()->route('permissions.index')
                ->with('error', __('common.invalid_permission_information_has_been_provided.'));
        }

        return $this->view('edit', [
            'permission' => $permission
        ]);
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
        $permission = Permission::find($id);

        if (empty($permission)) {
            return \redirect()->route('permissions.index')
                ->with('error', __('common.invalid_permission_information_has_been_provided.'));
        }

        try {
            $permission->name = Format::toSingle($request->name);
            $permission->label = $request->label ?: Format::label($request->name);

            if ($request->table_name) {
                $permission->table_name = $request->table_name;
            }

            $permission->save();

            return \redirect()->route('permissions.index')
                ->with('success', __("common.permission_has_been_updated_successfully."));
        } catch (\Throwable $th) {
            return \redirect()->route('permissions.index')
                ->with('error', __('common.permission_updating_failed._please,_try_again.'));
        }
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
