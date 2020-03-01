<?php

declare(strict_types=1);

namespace App\Util;

use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\Validator\Constraint as ValidatorConstraint;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validation;

class MatchesConstraints extends Constraint
{
    /**
     * @var ValidatorConstraint
     */
    private $constraint;
    /**
     * @var string|GroupSequence|(string|GroupSequence)[]|null
     */
    private $groups;
    /**
     * @var string
     */
    private $message = 'matches constraints';

    /**
     * @param ValidatorConstraint|ValidatorConstraint[] $constraint
     * @param string|GroupSequence|(string|GroupSequence)[]|null $groups
     */
    public function __construct($constraint, $groups)
    {
        $this->constraint = $constraint;
        $this->groups = $groups;
    }

    /**
     * @inheritDoc
     */
    public function toString(): string
    {
        return $this->message;
    }

    protected function matches($other): bool
    {
        $constraintViolationList = Validation::createValidator()->validate($other, $this->constraint, $this->groups);

        $message = [];
        /**
         * @var $item ConstraintViolationInterface
         */
        foreach ($constraintViolationList as $item) {
            $message[] = (string)$item;
        }

        $this->message = "\r\n" . implode("\r\n", $message);

        return \count($constraintViolationList) === 0;
    }
}