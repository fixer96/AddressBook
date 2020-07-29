<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\Contact;
use AppBundle\Service\ContactService;
use AppBundle\Service\ImageServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ContactServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testUploadImage(): void
    {
        $contact = new Contact();
        $oldImageName = 'oldImageName.png';
        $contact->setImageName($oldImageName);
        $image = new UploadedFile('/var/www/html/tests/resource/parrot.png', 'parrot.png');

        /** @var ImageServiceInterface|\PHPUnit_Framework_MockObject_MockObject $imageService */
        $imageService = $this->createMock(ImageServiceInterface::class);

        $newImageName = 'newImageName.png';
        $imageService->expects($this->once())
            ->method('generateImageName')
            ->with($image)
            ->willReturn($newImageName);

        $imageService->expects($this->once())
            ->method('removeImage')
            ->with($oldImageName);

        $imageService->expects($this->once())
            ->method('saveImage')
            ->with($image, $newImageName);

        $contactService = new ContactService($imageService);
        $contactService->uploadImage($image, $contact);

        $this->assertEquals($newImageName, $contact->getImageName());
    }
}
