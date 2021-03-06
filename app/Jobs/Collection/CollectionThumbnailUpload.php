<?php

namespace Closet\Jobs\Collection;

use Image;
use Closet\Models\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CollectionThumbnailUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $collection;
    public $fileName;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $collection, $fileName)
    {
      $this->collection = $collection;
      $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $local_path = storage_path('uploads/collection/thumbnail/') . $this->fileName;

      $img = Image::make($local_path)->encode('jpg')->fit(200, 200, function ($c){
          $c->upsize();
      });

      $img = $img->stream();

      Storage::disk('s3images')->put('collection/thumbnail/' . $this->fileName . '.jpg', $img->__toString());

      unlink($local_path);

      $this->collection->thumbnail = $this->fileName . '.jpg';
      $this->collection->save();
    }
}
