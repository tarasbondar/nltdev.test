<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactApiResource;
use App\Models\Contact;
use App\Services\NotesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsApiController extends Controller
{

    public function index(Request $request) {
        $contacts = Contact::all();
        return response()->json(ContactApiResource::collection($contacts));
    }

    public function store(Request $request) {
        $request->validate([
            'id' => 'nullable|exists:contacts,id',
            'user_id' => 'required|exists:users,id',
            'phone' => 'required|string|max:32'
        ]);

        try {
            DB::beginTransaction();

            if ($request->has('id')) {
                $user = Contact::find($request->get('id'));
            } else {
                $user = new Contact();
            }

            $user->user_id = $request->get('user_id');
            $user->phone = $request->get('phone');
            $user->save();

            DB::commit();
            return response()->json(['message' => 'ok']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function storeNote($id, Request $request) {
        $contact = Contact::findOrFail($id);
        if ($contact->note) {
            return response()->json(['message' => 'already exists']);
        }

        $request->validate([
            'note' => 'required|string|max:255'
        ]);

        $notesService = new NotesService();
        $response = $notesService->create([
            'note' => $request->get('note'),
            'notable_id' => $id,
            'notable_type' => 'App\Models\Contact'
        ]);

        return response()->json(['message' => $response]);
    }

    public function delete($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'ok']);
    }

    public function destroyNote($id) {
        $contact = Contact::findOrFail($id);
        if (!empty($contact->note)) {
            $notesService = new NotesService();
            $response = $notesService->delete($contact->note->id);
            return response()->json(['message' => $response]);
        }
        return response()->json(['message' => 'contact has no notes']);
    }

}
