<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingArea;
use App\Models\ShipDistrict;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{

	public function DivisionView(){
		$divisions = ShippingArea::orderBy('id','DESC')->get();
		return view('backend.ship.division.view_division',compact('divisions'));

	}


public function DivisionStore(Request $request){

    	$request->validate([
    		'division_name' => 'required',   	 

    	]);


		ShippingArea::insert([

		'division_name' => $request->division_name,
		'created_at' => Carbon::now(),

    	]);

	    $notification = array(
			'message' => 'Division Inserted Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);

    } // end method 

	public function DivisionEdit($id){

		$divisions = ShippingArea::findOrFail($id);
		   return view('backend.ship.division.edit_division',compact('divisions'));
		  }
	  
	  
	  
		  public function DivisionUpdate(Request $request,$id){
	  
			ShippingArea::findOrFail($id)->update([
	  
			  'division_name' => $request->division_name,
			  'created_at' => Carbon::now(),
	  
			  ]);
	  
			  $notification = array(
				  'message' => 'Division Updated Successfully',
				  'alert-type' => 'info'
			  );
	  
			  return redirect()->route('manage-division')->with($notification);
	  
	  
		  } // end mehtod 
	  
	  
		  public function DivisionDelete($id){
	  
			ShippingArea::findOrFail($id)->delete();
	  
			  $notification = array(
				  'message' => 'Division Deleted Successfully',
				  'alert-type' => 'info'
			  );
	  
			  return redirect()->back()->with($notification);
	  
		  } // end method 
	  

//// Start Ship District 

public function DistrictView(){
    $division = ShippingArea::orderBy('division_name','ASC')->get();
	$district = ShipDistrict::with('division')->orderBy('id','DESC')->get();
		return view('backend.ship.district.view_district',compact('division','district'));
    }

   //// End Ship District

   public function DistrictStore(Request $request){

	$request->validate([
		'division_id' => 'required',  
		'district_name' => 'required',  	 

	]);


ShipDistrict::insert([

	'division_id' => $request->division_id,
	'district_name' => $request->district_name,
	'created_at' => Carbon::now(),

	]);

	$notification = array(
		'message' => 'District Inserted Successfully',
		'alert-type' => 'success'
	);

	return redirect()->back()->with($notification);

} // end method 



public function DistrictEdit($id){

$division = ShippingArea::orderBy('division_name','ASC')->get();
$district = ShipDistrict::findOrFail($id);
 return view('backend.ship.district.edit_district',compact('district','division'));
}




public function DistrictUpdate(Request $request,$id){

	ShipDistrict::findOrFail($id)->update([

	'division_id' => $request->division_id,
	'district_name' => $request->district_name,
	'created_at' => Carbon::now(),

	]);

	$notification = array(
		'message' => 'District Updated Successfully',
		'alert-type' => 'info'
	);

	return redirect()->route('manage-district')->with($notification);


} // end mehtod 





  public function DistrictDelete($id){

	ShipDistrict::findOrFail($id)->delete();

	$notification = array(
		'message' => 'District Deleted Successfully',
		'alert-type' => 'info'
	);

	return redirect()->back()->with($notification);

} // end method 









}
