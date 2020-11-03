<?php

declare(strict_types=1);

namespace Symplify\CodingStandard\Tests\Rules\NoDuplicatedShortClassNameRule;

use Iterator;
use PHPStan\Rules\Rule;
use Symplify\CodingStandard\Tests\Rules\NoDuplicatedShortClassNameRule\Fixture\AlreadyExistingShortName as SecondAlreadyExistingShortName;
use Symplify\CodingStandard\Tests\Rules\NoDuplicatedShortClassNameRule\Source\AlreadyExistingShortName;
use Symplify\PHPStanExtensions\Testing\AbstractServiceAwareRuleTestCase;
use Symplify\PHPStanRules\Rules\NoDuplicatedShortClassNameRule;

final class NoDuplicatedShortClassNameRuleTest extends AbstractServiceAwareRuleTestCase
{
    /**
     * @dataProvider provideData()
     */
    public function testRule(string $filePath, array $expectedErrorMessagesWithLines): void
    {
        $this->analyse([$filePath], $expectedErrorMessagesWithLines);
    }

    public function provideData(): Iterator
    {
        // make sure both files are loaded
        require __DIR__ . '/Fixture/AlreadyExistingShortName.php';
        require __DIR__ . '/Source/AlreadyExistingShortName.php';

        $errorMessage = sprintf(
            NoDuplicatedShortClassNameRule::ERROR_MESSAGE,
            'AlreadyExistingShortName',
            implode('", "', [SecondAlreadyExistingShortName::class, AlreadyExistingShortName::class])
        );

        yield [__DIR__ . '/Fixture/AlreadyExistingShortName.php', [[$errorMessage, 7]]];
    }

    protected function getRule(): Rule
    {
        return $this->getRuleFromConfig(
            NoDuplicatedShortClassNameRule::class,
            __DIR__ . '/../../../config/symplify-rules.neon'
        );
    }
}
