<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\JsonResponses;
use App\Models\Forum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ForumController extends Controller
{
    public function all()
    {
        $forums = Forum::with('user')->latest()->get();

        $forums->transform(function ($item) {
            $item->image = $item->image ? url('/') . Storage::url($item->image) : null;
            return $item;
        });

        return new JsonResponses(Response::HTTP_OK, "Data berhasil didapatkan!", $forums);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,name',
            'image' => 'nullable|image',
            'description' => 'required|string',
        ]);

        $user = User::where('name', $data['user_id'])->firstOrFail();

        $data['user_id'] = $user->id;
        $data['image'] = $request->hasFile('image') ? $request->file('image')->store('images/forum', 'public') : null;

        $forum = Forum::create($data);

        return new JsonResponses(Response::HTTP_CREATED, "Data berhasil ditambahkan!", $forum);
    }

    public function detail($id)
    {
        $forum = Forum::with('user')->findOrFail($id);

        if ($forum->image) {
            $forum->image = url('/') . Storage::url($forum->image);
        } else {
            unset($forum->image);
        }

        return new JsonResponses(Response::HTTP_OK, "Satu data forum berhasil didapatkan!", $forum);
    }

    public function update(Request $request, $id)
    {
        $forum = Forum::findOrFail($id);

        $data = $request->validate([
            'image' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($forum->image && Storage::disk('public')->exists($forum->image)) {
                Storage::disk('public')->delete($forum->image);
            }
            $data['image'] = $request->file('image')->store('images/forum', 'public');
        }

        $forum->update($data);

        return new JsonResponses(Response::HTTP_OK, "Forum berhasil diperbarui!", $forum);
    }

    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);

        if ($forum->image && Storage::disk('public')->exists($forum->image)) {
            Storage::disk('public')->delete($forum->image);
        }

        $forum->delete();

        return new JsonResponses(Response::HTTP_OK, "Forum berhasil dihapus!", null);
    }
}
