<?php

namespace AppBundle\Service;

use AppBundle\Entity\Contact;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ContactService
{
    /**
     * @var ImageServiceInterface
     */
    private $imageService;

    /**
     * @param ImageServiceInterface $imageService
     */
    public function __construct(ImageServiceInterface $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param UploadedFile $image
     * @param Contact $contact
     */
    public function uploadImage(UploadedFile $image, Contact $contact): void
    {
        $imageName = $this->imageService->generateImageName($image);

        if ($contact->getImageName()) {
            $this->imageService->removeImage($contact->getImageName());
        }

        $this->imageService->saveImage($image, $imageName);
        $contact->setImageName($imageName);
    }
}
