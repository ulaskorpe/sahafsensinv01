<?php 

namespace App\Contracts;
use Illuminate\Http\Request;

interface CrudControllerInterface
{
    public function index();
    public function create();
    public function store(Request $request);
    public function show($id);
    public function edit($id);
    public function update(Request $request );
    public function destroy(Request $request);
    public function check_slug($slug,$id=0 );
}