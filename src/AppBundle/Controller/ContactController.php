<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use AppBundle\Form\ContactType;
use AppBundle\Service\ContactService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="contact_")
 */
class ContactController extends Controller
{
    /**
     * @Route(
     *     "/",
     *     name="index",
     *     methods={"GET"}
     * )
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param PaginatorInterface $paginator
     *
     * @return Response
     */
    public function indexAction(
        Request $request,
        EntityManagerInterface $entityManager,
        PaginatorInterface $paginator
    ): Response {
        $contactRepository = $entityManager->getRepository(Contact::class);
        $allContactsQuery = $contactRepository->createQueryBuilder('c')->getQuery();

        $pagination = $paginator->paginate(
            $allContactsQuery,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        return $this->render('contact/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route(
     *     "/create",
     *     name="create",
     *     methods={"GET", "POST"}
     * )
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param ContactService $contactService
     *
     * @return Response
     */
    public function createAction(
        Request $request,
        EntityManagerInterface $entityManager,
        ContactService $contactService
    ): Response {
        $contactForm = $this->createForm(ContactType::class, null, [
            'method' => 'POST',
            'action' => $this->generateUrl('contact_create')
        ]);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contact = $contactForm->getData();
            $image = $contactForm->get('image')->getData();

            if ($image instanceof UploadedFile) {
                $contactService->uploadImage($image, $contact);
            }

            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/create.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }

    /**
     * @Route(
     *     "/edit/{id}",
     *     name="edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id"="\d+"}
     * )
     *
     * @param Contact $contact
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param ContactService $contactService
     *
     * @return Response
     */
    public function editAction(
        Contact $contact,
        Request $request,
        EntityManagerInterface $entityManager,
        ContactService $contactService
    ): Response {
        $contactForm = $this->createForm(ContactType::class, $contact, [
            'method' => 'PUT',
            'action' => $this->generateUrl('contact_edit', ['id' => $contact->getId()])
        ]);

        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $image = $contactForm->get('image')->getData();

            if ($image instanceof UploadedFile) {
                $contactService->uploadImage($image, $contact);
            }

            $entityManager->flush();

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/edit.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }
}
