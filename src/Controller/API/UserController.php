<?php

namespace App\Controller\API;

use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use OpenApi\Annotations as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
class UserController extends AbstractController
{
    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns the user",
     *     @OA\JsonContent(ref=@Model(type=App\Entity\User::class))
     * )
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="The id of user",
     *     @OA\Schema(type="int")
     * )
     * @OA\Tag(name="user")
     */

    public function index() : JsonResponse
    {

        return new JsonResponse([
            '123',
            '123',
            '123',
        ], 200);
    }
}
