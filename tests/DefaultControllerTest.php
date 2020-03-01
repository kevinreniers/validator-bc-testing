<?php

namespace App\Tests;

use App\Util\Tester;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class DefaultControllerTest extends WebTestCase
{
    public function testIndexHasExpectedResponse(): void
    {
        $client = $this->createClient();
        $client->request('GET', '/default');

        $constraints = new Collection([
            'fields' => [
                'message' => new NotBlank(),
                'path' => new NotBlank(),
            ]
        ]);

        Tester::assertJsonMatchesConstraints($client->getResponse()->getContent(), $constraints);
    }

    public function testAllHasExpectedResponse(): void
    {
        $client = $this->createClient();
        $client->request('GET', '/all');

        $constraints = new Collection([
            'fields' => [
                'items' => new Required([
                    new Type('array'),
                    new Count(['min' => 1]),
                    new All([
                        new Collection([
                            'fields' => [
                                'first_name' => new NotBlank(),
                                'last_name' => new NotBlank(),
                                'date_of_birth' => new Date(),
                            ]
                        ])
                    ]),
                ]),
                'count' => new Required([new Type('int'), new Positive()]),
            ]
        ]);

        Tester::assertJsonMatchesConstraints($client->getResponse()->getContent(), $constraints);
    }
}
