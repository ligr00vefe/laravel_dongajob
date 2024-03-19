<?php

namespace App\Http\Controllers\Admin;

use App\Uploads\EDITOR;
use Illuminate\Http\Request;

class AdminUploadController extends EDITOR
{
    protected $from = '';

    public function run(Request $request)
    {
        $this->from = $request->path . " editor image upload";
        return $this->upload($request);
    }

}
