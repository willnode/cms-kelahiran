<?php
  
namespace App\Http\Controllers;
   
use App\Models\Kelahiran;
use Illuminate\Http\Request;
  
class KelahiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelahirans = Kelahiran::latest()->paginate(5);
    
        return view('kelahiran.index',compact('kelahirans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kelahiran.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    
        Kelahiran::create($request->all());
     
        return redirect()->route('kelahiran.index')
                        ->with('success','Kelahiran created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\Kelahiran  $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function show(Kelahiran $kelahiran)
    {
        return view('kelahiran.show',compact('kelahiran'));
    } 
     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelahiran  $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelahiran $kelahiran)
    {
        return view('kelahiran.edit',compact('kelahiran'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelahiran  $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelahiran $kelahiran)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
    
        $kelahiran->update($request->all());
    
        return redirect()->route('kelahirans.index')
                        ->with('success','Kelahiran updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelahiran  $kelahiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelahiran $kelahiran)
    {
        $kelahiran->delete();
    
        return redirect()->route('kelahiran.index')
                        ->with('success','Kelahiran deleted successfully');
    }
}