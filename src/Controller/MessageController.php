<?php

declare(strict_types=1);

namespace Caesar\SecurityMessageBundle\Controller;

use Caesar\SecurityMessageBundle\DTO\SecureMessage;
use Caesar\SecurityMessageBundle\Form\SecureMessageType;
use Caesar\SecurityMessageBundle\Service\SecureMessageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\Routing\Annotation\Route;
use Swagger\Annotations as SWG;

class MessageController extends AbstractController
{
    /**
     * @SWG\Tag(name="Secure Message")
     *
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     @Model(type="\Caesar\SecurityMessageBundle\Form\SecureMessageType")
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Success message created",
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(
     *             type="string",
     *             property="id",
     *             example="fc2b052450a6c890ffa510c2aa735c0178c71a03"
     *         )
     *     )
     * )
     *
     * @Route(
     *     "/message",
     *     name="security_message_message_create",
     *     methods={"POST"}
     * )
     *
     * @param Request $request
     * @param SecureMessageManager $messageManager
     *
     * @return array|FormInterface
     */
    public function createMessage(Request $request, SecureMessageManager $messageManager)
    {
        $message = new SecureMessage();
        $form = $this->createForm(SecureMessageType::class, $message);

        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $form;
        }

        $messageManager->save($message);

        return [
            'id' => $message->getId(),
        ];
    }

    /**
     * @SWG\Tag(name="Secure Message")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get message by id",
     *     @SWG\Schema(
     *         @Model(type="\Caesar\SecurityMessageBundle\DTO\SecureMessage")
     *     )
     * )
     *
     * @SWG\Response(
     *     response=404,
     *     description="Not found message"
     * )
     *
     * @Route(
     *     "/message/{id}",
     *     name="security_message_get_message_by_id",
     *     methods={"GET"}
     * )
     *
     * @param string $id
     * @param SecureMessageManager $messageManager
     *
     * @return SecureMessage
     */
    public function showMessage(string $id, SecureMessageManager $messageManager)
    {
        $message = $messageManager->get($id);

        if (empty($message)) {
            throw new NotFoundHttpException('No such message');
        }

        return $message;
    }
}
