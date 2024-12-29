<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OpenAIService;

class AIContentController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    function generate(Request $request){
        //  $request->validate([
        //     'prompt' => 'required|string',
        // ]);

        $response = $this->openAIService->generateContent(
            $request->input('prompt','Hell Open AI'),
            $request->input('max_tokens', 100),
            $request->input('temperature', 0.7)
        );

        return response()->json($response);
    }
}
