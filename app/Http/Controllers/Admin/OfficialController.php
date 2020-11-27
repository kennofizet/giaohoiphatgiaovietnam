<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Official;
use App\Model\OfficialCategorys;
use App\Model\OfficialPosition;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OfficialController extends Controller
{

    public function index()
    {
        $list_official = Official::orderBy('id','DESC')->get();
        return view('admin.official.index',[
            'list_official' => $list_official
        ]);
    }

    public function create()
    {
        $list_official_category = OfficialCategorys::all();
        $list_official_position = OfficialPosition::all();
        return view('admin.official.create',[
            'list_official_category' => $list_official_category,
            'list_official_position' => $list_official_position
        ]);
    }

    public function edit($id)
    {
        try {
            $detail_official_edit = Official::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return abort(404);
        };
        $list_official_category = OfficialCategorys::all();
        $list_official_position = OfficialPosition::all();

        return view('admin.official.edit',[
            'detail_official_edit' => $detail_official_edit,
            'list_official_category' => $list_official_category,
            'list_official_position' => $list_official_position
        ]);
    }

    public function detail($id)
    {
        try {
            $detail_official_view = Official::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return abort(404);
        };

        return view('admin.official.detail',[
            'detail_official_view' => $detail_official_view
        ]);
    }

    public function listCategory()
    {
        $list_official_category = OfficialCategorys::orderBy('id','DESC')->get();
        return view('admin.official.category.index',[
            'list_official_category' => $list_official_category
        ]);
    }

    public function createCategory()
    {
        return view('admin.official.category.create');
    }

    public function editCategory($id)
    {
        try {
            $detail_official_category_edit = OfficialCategorys::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return abort(404);
        };
        return view('admin.official.category.edit',[
            'detail_official_category_edit' => $detail_official_category_edit,
        ]);
    }

    public function listPosition()
    {
        $list_official_position = OfficialPosition::orderBy('id','DESC')->get();
        return view('admin.official.position.index',[
            'list_official_position' => $list_official_position
        ]);
    }

    public function createPosition()
    {
        return view('admin.official.position.create');
    }

    public function editPosition($id)
    {
        try {
            $detail_official_position_edit = OfficialPosition::findOrFail($id);
        } catch (ModelNotFoundException $ex) {
            return abort(404);
        };
        return view('admin.official.position.edit',[
            'detail_official_position_edit' => $detail_official_position_edit,
        ]);
    }

}
