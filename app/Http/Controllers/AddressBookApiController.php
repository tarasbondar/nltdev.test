<?php

namespace App\Http\Controllers;

use App\Http\Resources\AddressBookApiResource;
use App\Models\AddressBookRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressBookApiController extends Controller
{

    public function index() {
        $records = AddressBookRecord::all();
        return response()->json(AddressBookApiResource::collection($records));
    }

    public function store(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'contact_id' => 'required|exists:contacts,id',
        ]);

        try {
            DB::beginTransaction();

            if ($request->has('id')) {
                $record = AddressBookRecord::find($request->get('id'));
            } else {
                $record = new AddressBookRecord();
            }

            $record->contact_id = $request->get('contact_id');
            $record->user_id = $request->get('user_id');
            $record->save();

            DB::commit();
            return response()->json(['message' => 'ok']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function delete(Request $request) {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'contact_id' => 'required|exists:contact,id',
        ]);

        AddressBookRecord::where('user_id', '=', $request->get('user_id'))
            ->where('contact_id', '=', $request->get('contact_id'))
            ->delete();
        return response()->json(['message' => 'ok']);
    }
}
