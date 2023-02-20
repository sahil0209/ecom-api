<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserIssue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserIssuesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $issues = UserIssue::all();
        return $issues;
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',
            'user_id' => 'required'
        ]);
        $issuedata = new UserIssue;
        $issuedata->title = $request->title;
        $issuedata->description = $request->description;
        $issuedata->address = $request->address;
        $issuedata->user_id = $request->user_id;
        $issuedata->save();

        return ["success" => true, "message" => "Issue Inserted"];

    }

    public function userIssues($id)
    {
        $data = User::find($id)->userissues()->get();
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $issuedata = UserIssue::find($id);
        return $issuedata;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required',
            'comment' => 'required'
        ]);
        $issueupdate = UserIssue::find($id);
        $issueupdate->status = $request->status;
        $issueupdate->comment = $request->comment;
        $issueupdate->save();

        return ["success" => true, "message" => "Issue Updated"];

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $issueupdate = UserIssue::find($id);
        $issueupdate->delete();

        return ["success" => true, "message" => "Issue Deleted"];


    }
}