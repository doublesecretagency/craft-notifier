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

use doublesecretagency\notifier\web\twig\nodes\SetDataNode;
use Twig\Node\Expression\ConstantExpression;
use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Parses the {% setData %} Twig tag.
 *
 * @since 3.1.0
 */
class SetDataTokenParser extends AbstractTokenParser
{

    /**
     * @inheritdoc
     */
    public function parse(Token $token): Node
    {
        // Get Twig parser
        $parser = $this->parser;
        $stream = $parser->getStream();

        // Default to an empty dataset when no argument is given
        $data = new ConstantExpression(null, $token->getLine());

        // If an argument was provided, parse it (an associative array)
        if (!$stream->test(Token::BLOCK_END_TYPE)) {
            $data = $parser->getExpressionParser()->parseExpression();
        }

        // Expect the end of the tag
        $stream->expect(Token::BLOCK_END_TYPE);

        // Return the compiled node
        return new SetDataNode(['data' => $data], [], $token->getLine(), $this->getTag());
    }

    /**
     * @inheritdoc
     */
    public function getTag(): string
    {
        return 'setData';
    }

}
