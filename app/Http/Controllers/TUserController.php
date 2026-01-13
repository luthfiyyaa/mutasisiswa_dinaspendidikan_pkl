<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\GroupModel;
use App\Models\TUserModel;
use App\Models\MenuModel;

class TUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        //kalo perlu
        return view('admin.t_user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        //kalo perlu
        return view('admin.t_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'group_id' => 'required|exist:tbl_group, group.id',
            'menu_id' => 'nullable|array',
            'menu_id.*' => 'exists:tbl_menu,menu_id'
        ]);

        $group_id = $validated['group_id'];
        
        TUserModel::where('group_id', $group_id)->delete();

        // Insert menu baru jika ada
        if (!empty($validated['menu_id'])) {
            $data = collect($validated['menu_id'])->map(function ($menu_id) use ($group_id) {
                return [
                    'group_id' => $group_id,
                    'menu_id' => $menu_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            })->toArray();

            DB::table('tbl_t_user')->insert($data);
        }

        return redirect()
            ->route('t_user.show', $group_id)
            ->with('success', 'Hak akses menu berhasil diperbarui');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = MenuModel::orderBy('menu_id_parent','ASC')->get();
        $nama_group = GroupModel::where('group_id','=',$id)->value('group_nama');
        
        if (!$nama_group){
            abort(404, 'Group tidak ditemukan');
        }

        $t_user = TUserModel::join('tbl_menu','tbl_menu.menu_id','=','tbl_t_user.menu_id')->where('tbl_t_user.group_id','=',$id)->get();

        $menu2 = MenuModel::where('menu_id_parent','=','0')->get();

        return view('admin.t_user.menu', compact('menu', 'nama_group','id','t_user','menu2'))->with('error',0);
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
        $t_user = TUserModel::findOrFail($id);
        return view('admin.t_user.edit', compact('tUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        //
        $validated = $request->validate([
            'group_id' => 'required|exists:tbl_group,group_id',
            'menu_id' => 'required|exists:tbl_menu,menu_id'
        ]);

        $t_user = TUserModel::findOrFail($id);
        $t_user->update($validated);

        return redirect()
            ->route('t_user.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): RedirectResponse
    { 
        $group_id = $t_user->group_id;
        $t_user = TUserModel::findOrFail($id);
        $t_user->delete();
        return redirect()
            ->route('t_user.show', $groupId)
            ->with('success', 'Hak akses menu berhasil dihapus');

    }

     public function bulkDelete(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:tbl_group,group_id',
            'menu_ids' => 'required|array',
            'menu_ids.*' => 'exists:tbl_t_user,t_user_id'
        ]);

        TUserModel::whereIn('t_user_id', $validated['menu_ids'])
            ->where('group_id', $validated['group_id'])
            ->delete();

        return redirect()
            ->route('t_user.show', $validated['group_id'])
            ->with('success', 'Hak akses menu berhasil dihapus');
    }

}