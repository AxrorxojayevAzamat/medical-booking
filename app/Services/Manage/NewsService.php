<?php


namespace App\Services\Manage;


use App\Entity\News;
use App\Helpers\ImageHelper;
use App\Http\Requests\Admin\News\CreateRequest;
use App\Http\Requests\Admin\News\UpdateRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    private $nextId;

    public function create(CreateRequest $request): News
    {
        if (!$request->image) {
            return News::create([
                'title_uz' => $request->title_uz,
                'title_ru' => $request->title_ru,
                'menu_title_uz' => $request->menu_title_uz,
                'menu_title_ru' => $request->menu_title_ru,
                'description_uz' => $request->description_uz,
                'description_ru' => $request->description_ru,
                'content_uz' => $request->content_uz,
                'content_ru' => $request->content_ru,
                'status' => $request->status,
            ]);
        }

        $imageName = ImageHelper::getRandomName($request->image);

        $news = News::add($this->getNextId(), $request, $imageName);

        $this->uploadImage($this->getNextId(), $request->image, $imageName);

        return $news;
    }

    public function update(int $id, UpdateRequest $request): News
    {
        $news = News::findOrFail($id);

        if (!$request->image) {
            $news->edit($request);
        } else {
            Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_NEWS . '/' . $news->id);

            $imageName = ImageHelper::getRandomName($request->image);
            $news->edit($request, $imageName);

            $this->uploadImage($news->id, $request->image, $imageName);
        }

        return $news;
    }

    public function getNextId(): int
    {
        if (!$this->nextId) {
            $nextId = DB::select("select nextval('news_id_seq')");
            return $this->nextId = intval($nextId['0']->nextval);
        }
        return $this->nextId;
    }

    public function removeImage(int $id): bool
    {
        $news = News::findOrFail($id);
        $deleted = Storage::disk('public')->deleteDirectory('/images/' . ImageHelper::FOLDER_NEWS . '/' . $news->id);
        $updated = $news->update(['image' => null]);
        return  $deleted || $updated;
    }

    private function uploadImage(int $id, UploadedFile $image, string $imageName): string
    {
        $sizes = getimagesize($image);

        $listImageName = ImageHelper::getThumbnailName($imageName, News::IMAGE_WIDTH_LIST, News::IMAGE_HEIGHT_LIST);
        $detailImageName = ImageHelper::getThumbnailName($imageName, News::IMAGE_WIDTH_DETAIL, News::IMAGE_HEIGHT_DETAIL);

        ImageHelper::saveThumbnail($id, ImageHelper::FOLDER_NEWS, $image, $imageName, (int) ($sizes[0] / 4), (int) ($sizes[1] / 4));
        ImageHelper::saveThumbnail($id, ImageHelper::FOLDER_NEWS, $image, $listImageName, News::IMAGE_WIDTH_LIST, News::IMAGE_HEIGHT_LIST);
        ImageHelper::saveThumbnail($id, ImageHelper::FOLDER_NEWS, $image, $detailImageName, News::IMAGE_WIDTH_DETAIL, News::IMAGE_HEIGHT_DETAIL);
        ImageHelper::saveOriginal($id, ImageHelper::FOLDER_NEWS, $image, $imageName);

        return $imageName;
    }
}
