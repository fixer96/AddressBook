<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageServiceInterface
{
    /**
     * @param UploadedFile $image
     *
     * @return string
     */
    public function generateImageName(UploadedFile $image): string;

    /**
     * @param UploadedFile $image
     *
     * @param string $imageName
     */
    public function saveImage(UploadedFile $image, string $imageName): void;

    /**
     * @param string $imageName
     */
    public function removeImage(string $imageName): void;

    /**
     * @param string $imageName
     *
     * @return string
     */
    public function getImageUrl(string $imageName): string;
}
