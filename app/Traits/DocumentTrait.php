<?php

namespace App\Traits;

use App\Document;

trait DocumentTrait
{

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable')->latest();
    }

    public function uploadOrReplaceDocument($checkCurrentDocument, $name = null, $path = null, $type = null)
    {
        $attachment = Document::updateOrCreate($checkCurrentDocument,
                                    [
                                        'file_name' => $name,
                                        'file_path' => $path,
                                        'type' => $type,
                                        'file_size' => 0
                                    ]
                                );
        $this->documents()->save($attachment);
        return $attachment;
    }

    // CV User
    public function cv()
    {
        return $this->morphOne(MemberFile::class, 'documentable')->where('type', 1);
    }

}
