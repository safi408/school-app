<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeController extends Controller
{
    //
    public function notice(){
        return view('notices.create');
    }
    public function save_notice(Request $request){
    $request->validate([
        'title' => 'required|string|max:255',
    ]);
    $notice = new Notice;
    $notice->title = $request->title;
    $notice->save();
    return back()->with('success', 'Notice added successfully!');
    }
    public function manage_notice(){
        $notices = Notice::latest()->get();
        return view('notices.manage',compact('notices'));
    }
    public function delete($id){
        $notice = Notice::find($id);
        $notice->delete();
        return back()->with('warning', 'Notice deleted successfully!');
    }
}
