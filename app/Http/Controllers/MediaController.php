<?php
namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Upload media (multiple allowed)
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref_table'     => 'required|string',
            'ref_id'        => 'required|integer',
            'media_files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4,pdf|max:5120',
        ]);

        $uploaded = [];

        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $index => $file) {

                // Simpan file
                $path = $file->store('uploads/' . $request->ref_table, 'public');

                // Simpan ke database
                $media = Media::create([
                    'ref_table'  => $request->ref_table,
                    'ref_id'     => $request->ref_id,
                    'file_name'  => $path,
                    'caption'    => $request->caption ?? null,
                    'mime_type'  => $file->getClientMimeType(),
                    'sort_order' => $index,
                ]);

                $uploaded[] = $media;
            }
        }

        return response()->json([
            'status'  => 'success',
            'message' => 'Media uploaded successfully.',
            'data'    => $uploaded,
        ]);
    }

    /**
     * Update caption or sort order
     */
    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $media->update([
            'caption'    => $request->caption ?? $media->caption,
            'sort_order' => $request->sort_order ?? $media->sort_order,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Media updated successfully.',
            'data'    => $media,
        ]);
    }

    /**
     * Delete media (including file)
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Hapus file fisik
        if (Storage::disk('public')->exists($media->file_name)) {
            Storage::disk('public')->delete($media->file_name);
        }

        // Hapus dari database
        $media->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Media deleted successfully.',
        ]);
    }
}