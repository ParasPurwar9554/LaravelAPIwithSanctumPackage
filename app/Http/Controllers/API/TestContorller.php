<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Services\ParasService;


class TestContorller extends Controller
{
    protected $parasService;

    public function __construct(ParasService $parasService)
    {
        $this->parasService = $parasService;
    }

    function test(Request $request){
        print_r($this->parasService);
        return $this->parasService->fullName();
    }
}
