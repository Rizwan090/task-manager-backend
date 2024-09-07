<?php

namespace Modules\Core\Contracts\Repositories;

use Illuminate\Support\Collection;
use Modules\Tour\Entities\TravelStyle;
use Modules\Tour\Enum\TravelStyleTypes;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface PermissionRoleRepositoryContract
{

    /**
     * @param string $name
     * @param string $content
     * @param bool $is_group
     * @param UploadedFile|null $file
     * @return TravelStyle
     */
    public function create(
        string   $name,
        string   $content,
        bool   $is_group,
        ?UploadedFile $file,
    ): TravelStyle;

    /**
     * @return Collection|null
     */
    public function getTravelStyles(): ?Collection;

    /**
     * @param string $id
     * @return TravelStyle|null
     */
    public function findById(string $id): ?TravelStyle;

    /**
     * @param TravelStyle $travelStyle
     * @return bool
     */
    public function deleteTravelStyle(TravelStyle $travelStyle): bool;


    /**
     * @param TravelStyle $objTravelStyle
     * @param string|null $strName
     * @param string|null $strContent
     * @param bool|null $isGroup
     * @param UploadedFile|null $uploadedFile
     * @return TravelStyle
     */
    public function updateTravelStyle(
        TravelStyle $objTravelStyle,
        ?string $strName = null,
        ?string $strContent= null,
        ?bool $isGroup= null,
        ?UploadedFile $uploadedFile = null,
    ): TravelStyle;
}
