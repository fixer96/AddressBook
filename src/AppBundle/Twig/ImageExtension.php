<?php

namespace AppBundle\Twig;

use AppBundle\Service\ImageServiceInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ImageExtension extends AbstractExtension
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
     * {@inheritDoc}
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('image_url', [$this, 'getImageUrl']),
        ];
    }

    /**
     * @param string $imageName
     *
     * @return string
     */
    public function getImageUrl(string $imageName): string
    {
        return $this->imageService->getImageUrl($imageName);
    }
}
