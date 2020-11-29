<?php

/**
 * @package Flarum Action Log
 * @author Sami "SychO" Mazouz (https://github.com/SychO9)
 * @version 0.1.0
 * @license MIT
 */

namespace SychO\ActionLog\Search\Gambit;

use SychO\ActionLog\Search\ActionLogSearch;
use Flarum\Search\AbstractRegexGambit;
use Flarum\Search\AbstractSearch;
use LogicException;

class ActionGambit extends AbstractRegexGambit
{
    /**
     * @inheritDoc
     */
    protected $pattern = 'action:(.+)';

    /**
     * @inheritDoc
     */
    protected function conditions(AbstractSearch $search, array $matches, $negate)
    {
        if (! $search instanceof ActionLogSearch) {
            throw new LogicException('This gambit can only be applied on a ActionLogSearch');
        }

        $search->getQuery()->where('name', $negate ? '!=' : '=', trim($matches[1], '"'), 'and');
    }
}
