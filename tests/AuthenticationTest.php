<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;


class AuthenticationTest extends ApiTestCase
{


    public function testLogin(): void
    {
        $client = self::createClient();
        $container = self::getContainer();

        $user = new User();
        $username = time()."L";
        $user->setUsername($username);
        $user->setPassword(
            $container->get('security.user_password_hasher')->hashPassword($user, '$3CR3T')
        );
        $user->setRoles(['ROLE_USER']);

        $manager = $container->get('doctrine')->getManager();
        $manager->persist($user);
        $manager->flush();

        // retrieve a token
        $response = $client->request('POST', '/auth', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => $username,
                'password' => '$3CR3T',
            ],
        ]);

        $json = $response->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $json);

        // test not authorized
        $client->request('GET', '/api/hosts');
        $this->assertResponseStatusCodeSame(401);

        // test authorized
        $client->request('GET', '/api/hosts', ['auth_bearer' => $json['token']]);
        $this->assertResponseIsSuccessful();

        $entity = $manager->merge($user);
        $manager->remove($entity);
        $manager->flush();
    }
}