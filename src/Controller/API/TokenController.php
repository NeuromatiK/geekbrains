<?php

namespace App\Controller\API;

use App\Entity\RefreshToken;
use App\Entity\User;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TokenController extends AbstractController
{
    public function login(Request $request) : JsonResponse
    {

        try {
            $json = json_decode($request->getContent(), JSON_THROW_ON_ERROR);
        }
        catch ( \Exception $e ) {
            return new JsonResponse([], JsonResponse::HTTP_BAD_REQUEST);
        }
        if ($json === null) {
            return new JsonResponse([], JsonResponse::HTTP_BAD_REQUEST);
        }
        $login = $json['login'] ?? null;
        $pass = $json['password'] ?? null;

        if ($login !== null && $pass !== null) {

            $userManager = $this->getDoctrine()->getRepository(User::class);
            $tokenManager = $this->getDoctrine()->getManager();
            /* @var $user User */
            $user = $userManager->findOneBy([ 'email' => $login ]);
            $key = '123';
            $refreshToken = new RefreshToken();
            $refreshToken->setUserId($user->getId());
            $refreshToken->setCreatedAt(new \DateTimeImmutable());
            $refreshToken->setIp($request->getClientIp());
            $refreshToken->setRefreshToken(md5(microtime(true) . $request->getClientIp()));
            $refreshToken->setUa($request->headers->get('User-Agent'));
            $refreshToken->setFingerprint(md5(json_encode($request->headers->all())));
            $refreshToken->setExpiresIn(time() + 600);
            $tokenManager->persist($refreshToken);
            $tokenManager->flush();

            if ($user) {
                $jwtToken = JWT::encode([ 'username' => 'alex' ], $key);

                return new JsonResponse([
                    'jwt'     => $jwtToken,
                    'refresh' => $refreshToken->getRefreshToken(),
                ]);
            }
        }

        return new JsonResponse([], JsonResponse::HTTP_BAD_REQUEST);
    }

    public function refresh(Request $request) : JsonResponse
    {

        try {
            $json = json_decode($request->getContent(), JSON_THROW_ON_ERROR);
        }
        catch ( \Exception $e ) {
            return new JsonResponse([], JsonResponse::HTTP_BAD_REQUEST);
        }
        if ($json === null) {
            return new JsonResponse([], JsonResponse::HTTP_BAD_REQUEST);
        }

        $refreshToken = $json['refreshToken'] ?? null;
        $refreshManager = $this->getDoctrine()->getRepository(RefreshToken::class);
        $oldToken = $refreshManager->findOneBy([
            'refresh_token' => $refreshToken,
            'is_deleted'    => 0,
        ]);
        $tokenManager = $this->getDoctrine()->getManager();
        if ($oldToken) {
            $tokenManager->persist($oldToken);
            $refreshToken = new RefreshToken();
            $refreshToken->setUserId($oldToken->getUserId());
            $refreshToken->setCreatedAt(new \DateTimeImmutable());
            $refreshToken->setIp($request->getClientIp());
            $refreshToken->setRefreshToken(md5(microtime(true) . $request->getClientIp()));
            $refreshToken->setUa($request->headers->get('User-Agent'));
            $refreshToken->setFingerprint(md5(json_encode($request->headers->all())));
            $refreshToken->setExpiresIn(time() + 600);
            $tokenManager->persist($refreshToken);
            $tokenManager->remove($oldToken);
            $tokenManager->flush();

            return new JsonResponse([ 'refresh' => $refreshToken->getRefreshToken() ]);
        }

        return new JsonResponse([], JsonResponse::HTTP_NOT_FOUND);
    }
}
