<?php

namespace App\Services;

use App\Models\Note;

class NotesService {

    public function create($args) {
        $note = new Note();
        $note->note = $args['note'];
        $note->notable_id = $args['notable_id'];
        $note->notable_type = $args['notable_type'];
        if ($note->save()) {
            return 'ok';
        }
        return 'error';
    }

    public function delete($id) {
        $note = Note::find($id);
        if (empty($note)) {
            return 'note not found';
        }
        if ($note->delete()) {
            return 'ok';
        }
        return 'error';
    }

}
