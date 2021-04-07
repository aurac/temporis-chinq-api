<?php
/**
 * CreateMediaObjectAction.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 06/04/2021
 *
 * @version 1.0
 */

namespace App\Controller;


use App\Entity\MediaObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateMediaObjectAction
{
    public function __invoke(Request $request): MediaObject
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;

        return $mediaObject;
    }
}