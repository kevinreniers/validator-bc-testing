<?php

namespace App\Tests;

use App\Util\Tester;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use function App\Util\assertMatchesConstraints;

class DefaultControllerTest extends WebTestCase
{
    public function testSomething(): void
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
}
