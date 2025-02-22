<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressBookApiResource;
use App\Http\Resources\UserApiResource;
use App\Models\User;
use App\Services\NotesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersApiController extends Controller
{

    public function index(Request $request) {
        $users = User::all();
        return response()->json(UserApiResource::collection($users));
    }

    public function addressBook($id) {
        $user = User::findOrFail($id);
        return response()->json(AddressBookApiResource::collection($user->addressBookRecords));
    }

    public function store (Request $request) {
        $request->validate([
            'id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:32',
            'email' => 'required|email',
            'password' => 'required|string|max:32'
        ]);

        try {
            DB::beginTransaction();

            if ($request->has('id')) {
                $user = User::find($request->get('id'));
            } else {
                $user = new User();
            }

            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = Hash::make($request->get('password'));
            $user->save();

            DB::commit();
            return response()->json(['message' => 'ok']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function storeNote($id, Request $request) {
        $user = User::findOrFail($id);
        if ($user->note) {
            return response()->json(['message' => 'already exists']);
        }

        $request->validate([
            'note' => 'required|string|max:255'
        ]);

        $notesService = new NotesService();
        $response = $notesService->create([
            'note' => $request->get('note'),
            'notable_id' => $id,
            'notable_type' => 'App\Models\User'
        ]);

        return response()->json(['message' => $response]);
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'ok']);
    }

    public function destroyNote($id) {
        $user = User::findOrFail($id);
        if (!empty($user->note)) {
            $notesService = new NotesService;
            $response = $notesService->delete($user->note->id);
            return response()->json(['message' => $response]);
        }
        return response()->json(['message' => 'user has no notes']);
    }

}
