<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FOS\UserBundle\Tests\Util;

use FOS\UserBundle\Util\Canonicalizer;
use PHPUnit\Framework\TestCase;

class CanonicalizerTest extends TestCase
{
    /**
     * @dataProvider canonicalizeProvider
     *
     * @param $source
     * @param $expectedResult
     */
    public function testCanonicalize($source, $expectedResult): void
    {
        $canonicalizer = new Canonicalizer();
        self::assertSame($expectedResult, $canonicalizer->canonicalize($source));
    }

    public function canonicalizeProvider(): array
    {
        return [
            [null, null],
            ['FOO', 'foo'],
            [chr(171), PHP_VERSION_ID < 50600 ? chr(171) : '?'],
        ];
    }
}
