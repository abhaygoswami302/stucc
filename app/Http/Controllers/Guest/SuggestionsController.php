<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    public function index(Request $request)
    {
        Suggestion::create($request->all());
        return redirect()->route('coming.soon.collections')->with('message', 'Thank You For Your Suggestion');
    }
}
