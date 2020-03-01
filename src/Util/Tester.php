<?php

declare(strict_types=1);

namespace App\Util;

use function PHPUnit\Framework\assertJson;
use function PHPUnit\Framework\assertThat;

class Tester
{
    public static function assertJsonMatchesConstraints($json, $constraints, $groups = null): void
    {
        assertJson($json);
        $contents = json_decode($json, true);

        self::assertMatchesConstraints($contents, $constraints, $groups);
    }

    public static function assertMatchesConstraints($value, $constraints, $groups = null): void
    {
        $matchesConstraints = new MatchesConstraints($constraints, $groups);

        assertThat($value, $matchesConstraints);
    }
}