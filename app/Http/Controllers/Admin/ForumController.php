<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Forum::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })->orWhere('description', 'like', "%{$request->search}%");
        }

        $forum = $query->orderBy('id', 'desc')->paginate(5);
        return view('admin.forum.index', compact('forum'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $forum = Forum::findOrFail($id);
            $forum->delete();
            return back()->withSuccess('Data berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors('Data gagal dihapus! ' . $e->getMessage());
        }
    }
}
