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
 * Compiled node for the {% setData %} tag.
 *
 * @since 3.1.0
 */
class SetDataNode extends Node
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
            ->write('$__notifierDispatch = \\doublesecretagency\\notifier\\NotifierPlugin::$plugin->activeDispatchForData;')
            ->raw("\n");

        // Guard: only push when a Dynamic Data parse is in progress
        $compiler
            ->write('if (null !== $__notifierDispatch) {')
            ->raw("\n")
            ->indent();

        // Evaluate the tag argument exactly once into a local variable
        $compiler
            ->write('$__notifierData = ')
            ->subcompile($this->getNode('data'))
            ->raw(";\n");

        // Mark that the setData tag was invoked
        $compiler
            ->write('$__notifierDispatch->setDataInvoked = true;')
            ->raw("\n");

        // If the argument is an associative array (or Traversable), merge its keys
        // into the collected data; otherwise ignore it
        $compiler
            ->write('if (is_iterable($__notifierData)) {')
            ->raw("\n")
            ->indent()
            ->write('foreach ($__notifierData as $__notifierKey => $__notifierValue) {')
            ->raw("\n")
            ->indent()
            ->write('$__notifierDispatch->collectedDynamicData[$__notifierKey] = $__notifierValue;')
            ->raw("\n")
            ->outdent()
            ->write("}\n")
            ->outdent()
            ->write("}\n");

        // Close the guard
        $compiler
            ->outdent()
            ->write("}\n");
    }

}
