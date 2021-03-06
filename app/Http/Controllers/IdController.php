<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use App\Id;

class IdController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'type'          => 'required',
            'lastName'      => 'required',
            'firstName'     => 'required',
            'mi'            => 'required|max:1',
            'address'       => 'required',
            'contactno'     => 'required',
            'designation'   => 'required',
            'bday'          => 'required|date',
            'contactPerson' => 'required',
            'cpc'           => 'required',
            'cpa'           => 'required',
            'photo'         => 'required',
            // 'sign'          => 'required',
            'expiration'          => 'required',
        ]);

        // DETAILS SHOW IN QRCODE
        $qr = 'Name: '.$request->firstName.' '.$request->lastName.PHP_EOL. 
              'Type: '.$request->type;
        
        // GENERATE QRCODE
        QrCode::format('png')
                ->size(300)
                ->color(21,87,109)
                ->merge('/public/img/png/logo1.png', .1)
                ->errorCorrection('H')
                ->generate($qr, 'img/qrcodes/'.$request->firstName.$request->lastName.$request->bday.'.png');

        // INSERT INTO DATABASE
        $id = new Id;
        $lastid = $id::select('id')->latest()->first();
        $num = 0;
        if (!is_null($lastid)) {
            $id->empid = date('Y').'-'.$lastid->id++;
        } else {
            $id->empid = date('Y').'-'.++$num;
        }
        $id->type = $request->type;
        $id->lastName = $request->lastName;
        $id->firstName = $request->firstName;
        $id->mi = $request->mi;
        $id->address = $request->address;
        $id->contactno = $request->contactno;
        $id->designation = $request->designation;
        $id->bday = $request->bday;
        $id->contactPerson = $request->contactPerson;
        $id->cpc = $request->cpc;
        $id->cpa = $request->cpa;
        $id->tin = $request->tin;
        $id->sss = $request->sss;
        $id->philhealth = $request->philhealth;
        $id->pagibig = $request->pagibig;
        $id->school = $request->school;
        $id->hrs = $request->hrs;
        $id->adv = $request->adv;
        $id->advcontact = $request->advcontact;
        // EXPIRATION
        // $expire = date('Y-m-d',strtotime(date("Y-m-d") . " + 366 day"));
        $id->expiration = $request->expiration;
        // PHOTO
        $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('img/photo/') . $name);
        $id->photo = $name;
        // SIGNATURE
        if(!empty($request->sign)) {
	        $sign = time() . '.' . explode('/', explode(':', substr($request->sign, 0, strpos($request->sign, ';')))[1])[1];
	        \Image::make($request->sign)->save(public_path('img/sign/') . $sign);
	        $id->sign = $sign;
        }
        // QR CODE
        $id->qrcode = $request->firstName.$request->lastName.$request->bday.'.png';

        // $id->status = 'Pending';

        $id->save();

        return 'success';
    }
    
    
    public function update(Request $request)
    {
        $this->validate($request, [
        	'empid'			=> 'required',
            'type'          => 'required',
            'lastName'      => 'required',
            'firstName'     => 'required',
            'mi'            => 'required|max:1',
            'address'       => 'required',
            'contactno'     => 'required',
            'designation'   => 'required',
            'bday'          => 'required|date',
            'contactPerson' => 'required',
            'cpc'           => 'required',
            'cpa'           => 'required',
            'photo'         => 'required',
            // 'sign'          => 'required',
            'expiration'    => 'required',
        ]);

        // UPDATE DATABASE
        $id = Id::findOrFail($request->id);
        if($request->photo != $id->photo) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/photo/') . $name);
            $request->photo = $name;
        }
        
        if($request->sign != $id->sign) {
            $sign = time() . '.' . explode('/', explode(':', substr($request->sign, 0, strpos($request->sign, ';')))[1])[1];
            \Image::make($request->sign)->resize(150, 60)->save(public_path('img/sign/') . $sign);
            $request->sign = $sign;
        }
        
        $id->update([
        	'empid' => $request->empid,
        	'type' => $request->type,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'mi' => $request->mi,
            'address' => $request->address,
            'contactno' => $request->contactno,
            'designation' => $request->designation,
            'bday' => $request->bday,
            'expiration' => $request->expiration,
            'contactPerson' => $request->contactPerson,
            'cpc' => $request->cpc,
            'cpa' => $request->cpa,
            'tin' => $request->tin,
            'sss' => $request->sss,
            'philhealth' => $request->philhealth,
            'pagibig' => $request->pagibig,
            'school' => $request->school,
            'hrs' => $request->hrs,
            'adv' => $request->adv,
            'advcontact' => $request->advcontact,
            'photo' => $request->photo,
            'sign' => $request->sign,
        ]);
        

        return "Update Success!";
    }


    public function delete($id)
    {
        $del_id = Id::findOrFail($id);
        $del_id->delete();
        return 'Delete Success';
    }


    public function loadid() 
    {
        $ids = Id::latest()->get();

        return $ids;
    }


    public function sortid(Request $request) 
    {
        if($request->q == 'asc') {
            $ids = Id::oldest()->get();
        } elseif($request->q == 'des') {
            $ids = Id::latest()->get();
        } else {
            $ids = Id::orderBy('lastName', 'asc')->get();
        }

        return $ids;
    }


    public function printview(Request $request)
    {
        $selected = explode(',', $request->q);
        $ids = Id::whereIn('id', $selected)->get();

        return $ids;
    }


    public function printed(Request $request)
    {
        $selected = explode(',', $request->q);
        $ids = Id::whereIn('id', $selected)
                ->update(['status' => 'Printed']);

        return $ids;
    }
}
