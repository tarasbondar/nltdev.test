<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteApiResource;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotesApiController extends Controller
{

    public function index(Request $request) {
        $notes = Note::all();
        return response()->json(NoteApiResource::collection($notes));
    }

    public function store(Request $request) {
        $request->validate([
            'id' => 'nullable|exists:notes,id',
            'note' => 'required|string|max:256',
        ]);

        try {
            DB::beginTransaction();

            if ($request->has('id')) {
                $user = Note::find($request->get('id'));
            } else {
                $user = new Note();
            }

            $user->note = $request->get('note');
            $user->save();

            DB::commit();
            return response()->json(['message' => 'ok']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function delete($id) {
        $note = Note::findOrFail($id);
        $note->delete();
        return response()->json(['message' => 'ok']);
    }
}
