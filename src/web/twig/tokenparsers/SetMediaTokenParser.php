<?php
/**
 * Notifier plugin for Craft CMS
 *
 * First-class Notifications for Craft CMS.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\web\twig\tokenparsers;

use doublesecretagency\notifier\web\twig\nodes\SetMediaNode;
use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Parses the {% setMedia %} Twig tag.
 *
 * @since 3.1.0
 */
class SetMediaTokenParser extends AbstractTokenParser
{

    /**
     * @inheritdoc
     */
    public function parse(Token $token): Node
    {
        // Get Twig parser
        $parser = $this->parser;
        $stream = $parser->getStream();

        // If an expression follows, parse it
        // A bare {% setMedia %} is allowed, it just collects nothing
        if ($stream->test(Token::BLOCK_END_TYPE)) {
            $nodes = [];
        } else {
            $nodes = ['items' => $parser->getExpressionParser()->parseExpression()];
        }

        // Expect the end of the tag
        $stream->expect(Token::BLOCK_END_TYPE);

        // Return the compiled node
        return new SetMediaNode($nodes, [], $token->getLine(), $this->getTag());
    }

    /**
     * @inheritdoc
     */
    public function getTag(): string
    {
        return 'setMedia';
    }

}
