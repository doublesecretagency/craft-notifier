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
 * Compiled node for the {% setMedia %} tag.
 *
 * @since 3.1.0
 */
class SetMediaNode extends Node
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
            ->write('$__notifierDispatch = \\doublesecretagency\\notifier\\NotifierPlugin::$plugin->activeDispatchForMedia;')
            ->raw("\n");

        // Guard: only push when a media resolution is in progress
        $compiler
            ->write('if (null !== $__notifierDispatch) {')
            ->raw("\n")
            ->indent();

        // If an argument was passed, evaluate and collect it
        if ($this->hasNode('items')) {

            // Evaluate the tag argument exactly once into a local variable
            $compiler
                ->write('$__notifierItems = ')
                ->subcompile($this->getNode('items'))
                ->raw(";\n");

            // Mark that the setMedia tag was invoked (after the argument evaluates cleanly)
            $compiler
                ->write('$__notifierDispatch->setMediaInvoked = true;')
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
                ->write('$__notifierDispatch->collectedMedia[] = $__notifierItem;')
                ->raw("\n")
                ->outdent()
                ->write("}\n")
                ->outdent()
                ->write("} else {\n")
                ->indent()
                ->write('$__notifierDispatch->collectedMedia[] = $__notifierItems;')
                ->raw("\n")
                ->outdent()
                ->write("}\n");

        } else {

            // A bare {% setMedia %} ran but collects nothing
            $compiler
                ->write('$__notifierDispatch->setMediaInvoked = true;')
                ->raw("\n");

        }

        // Close the guard
        $compiler
            ->outdent()
            ->write("}\n");
    }

}
