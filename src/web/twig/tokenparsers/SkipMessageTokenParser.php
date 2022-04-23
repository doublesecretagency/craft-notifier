<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Send custom Twig messages when Craft events get triggered.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\web\twig\tokenparsers;

use doublesecretagency\notifier\web\twig\nodes\SkipMessageNode;
use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

/**
 * Class SkipMessageTokenParser
 * @since 1.0.0
 */
class SkipMessageTokenParser extends AbstractTokenParser
{

    /**
     * @inheritdoc
     */
    public function parse(Token $token): Node
    {
        // Get Twig parser
        $parser = $this->parser;
        $stream = $parser->getStream();

        $nodes = [];

        if ($stream->test(Token::STRING_TYPE)) {
            $nodes['message'] = $parser->getExpressionParser()->parseExpression();
        }

        $stream->expect(Token::BLOCK_END_TYPE);

        return new SkipMessageNode($nodes, [], $token->getLine(), $this->getTag());
    }

    /**
     * @inheritdoc
     */
    public function getTag(): string
    {
        return 'skipMessage';
    }

}
