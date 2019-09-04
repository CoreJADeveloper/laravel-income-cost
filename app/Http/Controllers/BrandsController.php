<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandsController extends Controller
{
  private $brandModel;

  public function __construct(){
    $this->brandModel = new Brand();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $brandRecords = $this->brandModel->get_all_brands();
    return view('brand.index')->with('records', $brandRecords);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('brand.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
        'company_name' => 'required'
    ]);

    $data['company_name'] = $request->get('company_name');
    $data['company_type'] = $request->get('company_type');
    $data['active'] = $request->get('active');

    $this->brandModel->insert_brand_record($data);
    return redirect('/brands')->with('success', 'Brand saved!');
  }
}
