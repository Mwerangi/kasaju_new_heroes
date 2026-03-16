<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Download;

class DownloadController extends Controller
{
    public function download($id)
    {
        $download = Download::active()->findOrFail($id);
        $download->incrementDownloadCount();
        
        $filePath = storage_path('app/public/' . $download->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }
        
        return response()->download($filePath, $download->file_name);
    }
}
