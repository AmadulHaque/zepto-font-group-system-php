<?php

namespace App\Controllers;

use App\Models\Font;
use App\Core\Validator;
use App\Models\FontGroup;
use Illuminate\Http\Request;

class FontGroupController 
{
    protected $fontGroup;
    protected $font;

    public function __construct() 
    {
        $this->fontGroup = new FontGroup();
        $this->font = new Font();
    }

    public function index() 
    {
        $fontGroups = $this->fontGroup->getGroups();
        return view('pages/font_group/index', ['fontGroups' => $fontGroups]);  
    }

    public function edit(Request $request) 
    {
        $fonts = $this->font->getAll(); 
        $fontGroup = $this->fontGroup->find($request->id);
        $group_fonts_list =  $this->fontGroup->findFonts($request->id); 
        return view('pages/font_group/edit', ['fonts' => $fonts,'fontGroup' => $fontGroup, 'group_fonts_list'=>$group_fonts_list ,'title' => 'Font List']);  
    }



    public function create() 
    {
        $fonts = $this->font->getAll(); 
        return view('pages/font_group/create', ['fonts' => $fonts, 'title' => 'Font List']);  
    }

    public function store(Request $request) 
    {
        $rules = [
            'group_name' => 'required',
            'font_id.*' => 'required',
            'name.*' => 'required',
            'size.*' => 'required',
            'price.*' => 'required',
        ];
        
        $validator = new Validator();
        $validator->validate($request->all(), $rules);
        
        if ($validator->fails()) {
            return jsonResponse(['errors' => $validator->getErrors()], 422);
        }

        $this->fontGroup->createGroup($request->all());

        // Return a success response
        return jsonResponse(['message' => 'Font group created successfully!'], 200);
    }


    public function update(Request $request) 
    {
        $rules = [
            'group_id' => 'required',
            'group_name' => 'required',
            'id.*' => 'required',
            'font_id.*' => 'required',
            'name.*' => 'required',
            'size.*' => 'required',
            'price.*' => 'required',
        ];
        
        $validator = new Validator();
        $validator->validate($request->all(), $rules);
        
        if ($validator->fails()) {
            return jsonResponse(['errors' => $validator->getErrors()], 422);
        }

        $this->fontGroup->updateGroup($request->all());

        // Return a success response
        return jsonResponse(['message' => 'Font group updated successfully!'], 200);
    }

    public function delete(Request $request)
    {
        $fontGroup =  $this->fontGroup->find($request->id);
    
        if (!$fontGroup) {
            return jsonResponse(['message' => 'FontGroup not found.'], 404);
        }

        $this->fontGroup->delete($request->id);
    
        return jsonResponse(['message' => 'FontGroup deleted successfully!'], 200);
    }
}
