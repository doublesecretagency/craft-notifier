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

use doublesecretagency\notifier\web\twig\nodes\SetRecipientsNode;
use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Parses the {% setRecipients %} Twig tag.
 *
 * @since 3.0.0
 */
class SetRecipientsTokenParser extends AbstractTokenParser
{

    /**
     * @inheritdoc
     */
    public function parse(Token $token): Node
    {
        // Get Twig parser
        $parser = $this->parser;
        $stream = $parser->getStream();

        // Parse the required items expression
        $items = $parser->getExpressionParser()->parseExpression();

        // Expect the end of the tag
        $stream->expect(Token::BLOCK_END_TYPE);

        // Return the compiled node
        return new SetRecipientsNode(['items' => $items], [], $token->getLine(), $this->getTag());
    }

    /**
     * @inheritdoc
     */
    public function getTag(): string
    {
        return 'setRecipients';
    }

}
