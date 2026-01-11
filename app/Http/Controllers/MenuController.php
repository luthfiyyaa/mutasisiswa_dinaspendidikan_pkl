<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MenuModel;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = MenuModel::where('menu_id_parent', '0')->get();
        return view('admin.menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'menu_id_parent' => 'required|integer',
            'menu_nama' => 'required|string|max:255',
            'menu_link' => 'required|string|max:255',
        ]);

        MenuModel::create([
            'menu_id_parent' => $validated['menu_id_parent'],
            'menu_nama' => $validated['menu_nama'],
            'menu_link' => $validated['menu_link'],
        ]);

        return response()->json(['success' => true, 'message' => 'Menu berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $menu = MenuModel::findOrFail($id);
        return response()->json($menu);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'menu_id_parent' => 'required|integer',
            'menu_nama' => 'required|string|max:255',
            'menu_link' => 'required|string|max:255',
        ]);

        $menu = MenuModel::findOrFail($id);
        $menu->update([
            'menu_id_parent' => $validated['menu_id_parent'],
            'menu_nama' => $validated['menu_nama'],
            'menu_link' => $validated['menu_link'],
        ]);

        return response()->json(['success' => true, 'message' => 'Menu berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $menu = MenuModel::findOrFail($id);
        $menu->delete();

        return response()->json(['success' => true, 'message' => 'Menu berhasil dihapus']);
    }

    /**
     * Get datatable listing
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function listData()
    {
        $menu = MenuModel::query()
            ->orderBy('menu_id', 'DESC')
            ->get();

        $data = $menu->map(function ($list, $index) {
            $nama_menu = $list->menu_id_parent != 0
                ? MenuModel::where('menu_id', $list->menu_id_parent)->value('menu_nama') ?? '--'
                : '--';

            return [
                $index + 1,
                $list->menu_nama,
                $list->menu_link,
                $nama_menu,
                sprintf(
                    '<a onclick="editForm(%d)" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Edit Data" style="color:white;"><i class="fa fa-edit"></i></a>
                    <a onclick="deleteData(%d)" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus Data" style="color:white;"><i class="fa fa-trash"></i></a>',
                    $list->menu_id,
                    $list->menu_id
                )
            ];
        })->toArray();

        return response()->json(['data' => $data]);
    }
}