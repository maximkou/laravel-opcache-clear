<?php

namespace Maximkou\LaravelOpcacheClear;

use Illuminate\Http\Request;

/**
 * Process clear request
 * Class OpcacheClearController
 * @package Maximkou\LaravelOpcacheClear
 */
class OpcacheClearController
{
    /**
     * @param Request $request
     * @param Cleaner $cleaner
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear(Request $request, Cleaner $cleaner)
    {
        return response()->json([
            'result' => $cleaner->clear($request->get('token'))
        ]);
    }
}
