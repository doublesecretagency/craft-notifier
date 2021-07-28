<?php
/**
 * Notifier plugin for Craft CMS
 *
 * Get notified when things happen.
 *
 * @author    Double Secret Agency
 * @link      https://plugins.doublesecretagency.com/
 * @copyright Copyright (c) 2021 Double Secret Agency
 */

namespace doublesecretagency\notifier\web\twig\nodes;

use Twig\Compiler;
use Twig\Error\RuntimeError;
use Twig\Node\Node;

/**
 * Class SkipMessageNode
 * @since 1.0.0
 */
class SkipMessageNode extends Node
{

    /**
     * @inheritdoc
     */
    public function compile(Compiler $compiler)
    {
        $runtimeError = RuntimeError::class;
        $message = "Message not sent because `skipMessage` was encountered while rendering the template.";

        // Get specified message
        if ($this->hasNode('message')) {
            $customMessage = $this->getNode('message')->getAttribute('value');
            if ($customMessage) {
                $message = "{$message} ({$customMessage})";
            }
        }

        // Escape single quotes to prevent conflict
        $message = preg_replace("/'/", "\'", $message);

        $compiler
            ->addDebugInfo($this)
            ->write("throw new {$runtimeError}('{$message}');\n")
        ;
    }

}
