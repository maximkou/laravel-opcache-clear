<?php

namespace Maximkou\LaravelOpcacheClear;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Process clear request
 * Class OpcacheClearController
 * @package Maximkou\LaravelOpcacheClear
 */
class OpcacheClearController extends Controller
{
    /**
     * @param Request $request
     * @param Cleaner $cleaner
     * @return \Illuminate\Http\JsonResponse
     */
    protected function clear(Request $request, Cleaner $cleaner)
    {
        return response()->json([
            'result' => $cleaner->clear($request->get('token'))
        ]);
    }
}
