<?php

namespace AppBundle\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageService implements ImageServiceInterface
{
    /**
     * @var string
     */
    private $webDirectory;

    /**
     * @var string
     */
    private $imageDirectory;

    /**
     * @param string $webDirectory
     * @param string $imageDirectory
     */
    public function __construct(string $webDirectory, string $imageDirectory)
    {
        $this->webDirectory = $webDirectory;
        $this->imageDirectory = $imageDirectory;
    }

    /**
     * {@inheritDoc}
     */
    public function generateImageName(UploadedFile $image): string
    {
        // @see https://symfony.com/doc/3.4/controller/upload_file.html
        $originalImageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $safeImageName = transliterator_transliterate(
            'Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()',
            $originalImageName
        );

        return $safeImageName.'-'.uniqid().'.'.$image->guessExtension();
    }

    /**
     * {@inheritDoc}
     */
    public function saveImage(UploadedFile $image, string $imageName): void
    {
        $directory = sprintf('%s/%s', $this->webDirectory, $this->imageDirectory);
        $image->move($directory, $imageName);
    }

    /**
     * {@inheritDoc}
     */
    public function removeImage(string $imageName): void
    {
        $imagePath = sprintf('%s/%s/%s', $this->webDirectory, $this->imageDirectory, $imageName);

        if (file_exists($imagePath)) {
            $fs = new Filesystem();
            $fs->remove($imagePath);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getImageUrl(string $imageName): string
    {
        return $this->imageDirectory . DIRECTORY_SEPARATOR . $imageName;
    }
}
