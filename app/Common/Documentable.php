<?php

namespace App\Common;

use App\Models\Document;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Attach this Trait to a User (or other model) for easier read/writes on Replies
 *
 * @author Inta-Dev
 */
trait Documentable
{

    /**
     * Check if model has an document.
     *
     * @return bool
     */
    public function hasDocument()
    {
        return (bool)$this->documents()->count();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable')->orderBy('order', 'asc');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function document()
    {
        return $this->morphOne(Document::class, 'documentable');
    }

    /**
     * Save document
     *
     * @param file $file
     * @return document model
     */
    public function saveDocument($file, $name, $order = 0)
    {
        $dir = file_storage_dir();
        // if(!Storage::exists($dir))
        // 	Storage::makeDirectory($dir, 0775, true, true);
        $path = Storage::put($dir, $file);

        return $this->createDocument($path, $name, $file->getClientOriginalName(), $file->getSize(),
            $file->getClientOriginalExtension(), $order);
    }

    /**
     * Update document
     *
     * @param file $file
     * @return image model
     */
    public
    function updateDocument($oldFile, $newFile, $name)
    {
        // Delete the old image if exist
        $this->deleteDocument($oldFile);

        return $this->saveDocument($newFile, $name);
    }

    /**
     * Deletes the given document.
     *
     * @return bool
     */
    public function deleteDocument($file = Null)
    {
        if (! $file) {
            $file = $this->document;
        }

        if (optional($file)->path) {
            Storage::delete($file->path);
            return $file->delete();
        }

        return;
    }


    /**
     * Create document model
     *
     * @return array
     */
    private function createDocument($path, $name, $doc_name, $size, $ext = '.pdf', $order = 0)
    {
        return $this->document()->create([
            'path' => $path,
            'name' => $name,
            'doc_name' => $doc_name,
            'ext' => $ext,
            'order' => $order,
            'size' => $size,
        ]);
    }

}
