<?php

namespace App\Controllers;

use Illuminate\Http\Request;
use App\Models\Font;

class FontController {


    public function index(Request $request) 
    {
        $fontModel = new Font();
        $fonts = $fontModel->getAll(); 
        return view('dashboard', ['fonts' => $fonts, 'title' => 'Font List']);
    }

    
    public function create() 
    {
        return view('pages/font/create', ['title' => 'Font Upload']);
    }


    public function store(Request $request) 
    {
        if ($request->hasFile('font') && $request->file('font')->isValid()) {
            $file = $request->file('font');
            $fileExtension = $file->getClientOriginalExtension();

            // Validate the file extension
            if ($fileExtension !== 'ttf') {
                return jsonResponse(['message' => 'Only .ttf files are allowed.'], 400);
            }
    
            // Set the upload directory
            $uploadFileDir = __DIR__ . '/../../public/uploads/fonts/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
    
            // Create a unique file name to avoid conflicts
            $newFileName = uniqid() . '.' . $fileExtension;
    
            // Move the file to the upload directory
            if ($file->move($uploadFileDir, $newFileName)) {
                // Save the font information in the database
                $fontModel = new Font();
                $data = [
                    'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'path' => '/uploads/fonts/'.$newFileName
                ];
                $fontModel->insert($data);
                
                return jsonResponse(['message' => 'Font uploaded and saved successfully!'], 200);
            } else {
                return jsonResponse(['message' => 'There was an error moving the uploaded file.'], 500);
            }
        }
    
        return jsonResponse(['message' => 'No file uploaded or an error occurred.'], 400);
    }
   

    public function delete(Request $request)
    {
        $fontModel = new Font();
        $font = $fontModel->find($request->id);
    
        if (!$font) {
            return jsonResponse(['message' => 'Font not found.'], 404);
        }
    
        // Delete the font file from the server
        $filePath = public_path($font['path']);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    
        $fontModel->delete($request->id);
    
        return jsonResponse(['message' => 'Font deleted successfully!'], 200);
    }
    
}
