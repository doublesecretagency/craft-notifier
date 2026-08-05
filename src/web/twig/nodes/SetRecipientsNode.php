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

namespace doublesecretagency\notifier\web\twig\nodes;

use Twig\Compiler;
use Twig\Node\Node;

/**
 * Compiled node for the {% setRecipients %} tag.
 *
 * @since 3.0.0
 */
class SetRecipientsNode extends Node
{

    /**
     * @inheritdoc
     */
    public function compile(Compiler $compiler): void
    {
        // Map compiled PHP back to the source Twig tag for debugging
        $compiler->addDebugInfo($this);

        // Cache the active dispatch into a uniquely-named local variable
        $compiler
            ->write('$__notifierDispatch = \\doublesecretagency\\notifier\\NotifierPlugin::$plugin->activeDispatchForRecipients;')
            ->raw("\n");

        // Guard: only push when a Dynamic Recipients resolution is in progress
        $compiler
            ->write('if (null !== $__notifierDispatch) {')
            ->raw("\n")
            ->indent();

        // Evaluate the tag argument exactly once into a local variable
        $compiler
            ->write('$__notifierItems = ')
            ->subcompile($this->getNode('items'))
            ->raw(";\n");

        // Mark that the setRecipients tag was invoked
        $compiler
            ->write('$__notifierDispatch->setRecipientsInvoked = true;')
            ->raw("\n");

        // If the argument is a collection (array, query, or Collection), iterate and push each item
        // A single Craft element is iterable too (it iterates its attributes), so exclude it and push as one item
        $compiler
            ->write('if (is_iterable($__notifierItems) && !($__notifierItems instanceof \\craft\\base\\ElementInterface)) {')
            ->raw("\n")
            ->indent()
            ->write('foreach ($__notifierItems as $__notifierItem) {')
            ->raw("\n")
            ->indent()
            ->write('$__notifierDispatch->collectedDynamicRecipients[] = $__notifierItem;')
            ->raw("\n")
            ->outdent()
            ->write("}\n")
            ->outdent()
            ->write("} else {\n")
            ->indent()
            ->write('$__notifierDispatch->collectedDynamicRecipients[] = $__notifierItems;')
            ->raw("\n")
            ->outdent()
            ->write("}\n");

        // Close the guard
        $compiler
            ->outdent()
            ->write("}\n");
    }

}
