<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Capture;
use Illuminate\Support\Facades\Storage;

class CaptureController extends Controller
{
    public function destroy(Capture $capture)
    {
        Storage::disk('public')->delete($capture->chemin);
        $capture->delete();

        return response()->json(['success' => true]);
    }
}
