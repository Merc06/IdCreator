<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use QrCode;
use App\Id;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type'          => 'required',
            'lastName'      => 'required',
            'firstName'     => 'required',
            'mi'            => 'required|max:1',
            'address'       => 'required',
            'contactno'     => 'required|integer',
            'designation'   => 'required',
            'bday'          => 'required|date',
            'contactPerson' => 'required',
            'cpc'           => 'required|integer',
            'cpa'           => 'required',
            'photo'         => 'required',
            'sign'          => 'required',
        ]);

        // DETAILS SHOW IN QRCODE
        $qr = 'Name: '.$request->firstName.' '.$request->lastName.PHP_EOL. 
              'Type: '.$request->type;
        
        // GENERATE QRCODE
        QrCode::format('png')
                ->generate($qr, 'img/qrcodes/'.$request->lastName.$request->bday.'.png');

        // INSERT INTO DATABASE
        $id = new Id;
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
        $expire = date('Y-m-d',strtotime(date("Y-m-d") . " + 366 day"));
        $id->expiration = $expire;
        // PHOTO
        $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
        \Image::make($request->photo)->save(public_path('img/photo/') . $name);
        $id->photo = $name;
        // SIGNATURE
        $sign = time() . '.' . explode('/', explode(':', substr($request->sign, 0, strpos($request->sign, ';')))[1])[1];
        \Image::make($request->sign)->save(public_path('img/sign/') . $sign);
        $id->sign = $sign;
        // QR CODE
        $id->qrcode = $request->lastName.$request->bday.'.png';

        $id->save();

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
