<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        return view('chat.index');
    }
    public function scndChat(Request $request)
    {
        try {
            $response = OpenAI::completions()->create([
                'engine' => 'davinci',
                'prompt' => $request->input('input'),
                'max_tokens' => 100
            ]);
            
            if ($response->successful()) {
                $responseText = $response->getData()['choices'][0]['text'];

                return response()->json(['response_text' => $responseText]);
            } else {
                return response()->json(['error' => 'Invalid response from OpenAI'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
