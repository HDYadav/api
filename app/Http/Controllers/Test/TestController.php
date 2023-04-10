<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Collection::macro('toUpper', function ($value) {
        //     return $this->map(function ($value) {
        //         return Str::upper($value);
        //     });
        // });
        
        // $collection = collect(['first', 'second','third','fourth']);
        
        // $upper = $collection->toUpper();
        // return $upper;

        $collection = collect([1, 2, 3, 4, 5]);

        $multiplied = $collection->map(function ($item, $key) {
            return $item * 2;
        });
        
        return $multiplied->all();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
