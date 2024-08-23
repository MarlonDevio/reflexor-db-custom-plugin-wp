<?php

namespace FP\Core;

/**
 * Class Hooks
 *
 * This class is responsible for automatically registering WordPress hooks (actions, filters, shortcodes)
 * by parsing the docblocks of methods within a given object instance.
 */
class Hooks
{
    /**
     * @var string PATTERN
     *
     * A regular expression pattern used to identify and extract hook annotations
     * from method docblocks. It looks for annotations like @filter, @action, or @shortcode,
     * followed by the hook name and optionally the priority.
     */
    private const PATTERN =
        '#\* @(?P<type>filter|action|shortcode)\s+(?P<name>[a-z0-9\-\.\/_]+)(\s+(?P<priority>\d+))?#';

    /**
     * Initializes the given object instance by registering all hooks defined in its docblocks.
     *
     * @param object $instance The object instance whose methods are to be scanned for hooks.
     * @return object The same object instance passed in, allowing for method chaining.
     *
     * This method processes the given object by scanning its methods' docblocks for hook annotations.
     * It registers each detected hook with WordPress using the appropriate add_action, add_filter, or add_shortcode function.
     */
    public static function init(object $instance): object
    {
        // Extract the hook configurations from the object's methods
        foreach (self::extract($instance) as $config) {
            // Dynamically call the appropriate WordPress hook registration function (add_action, add_filter, add_shortcode)
            call_user_func($config['hook'], $config['name'], $config['callback'], $config['priority'], $config['args']);
        }

        // Return the original object instance for method chaining or further use
        return $instance;
    }

    /**
     * Extracts hook configurations from the docblocks of the given object's methods.
     *
     * @param object $instance The object instance whose methods' docblocks will be parsed.
     * @return array An array of hook configurations that were identified in the docblocks.
     *
     * This method uses PHP's Reflection API to inspect the given object's methods.
     * It looks for docblocks that match the defined pattern and extracts the hook type, name,
     * priority, and the method to be used as the callback.
     */
    private static function extract(object $instance): array
    {
        // Array to store all extracted hook configurations
        $handlers = [];

        if (empty($instance)) {
            return $handlers;
        }

        // Create a ReflectionObject to inspect the provided object instance
        $reflector = new \ReflectionObject($instance);

        // Iterate over all methods in the object
        foreach ($reflector->getMethods() as $method) {
            // Check if the method's docblock matches the defined pattern
            if (preg_match_all(self::PATTERN, $method->getDocComment(), $matches, PREG_SET_ORDER)) {
                // For each match found in the docblock
                foreach ($matches as $match) {
                    // Build a hook configuration array for this method
                    $handlers[] = [
                        'hook' => sprintf('add_%s', $match['type']), // Determine the WordPress hook function (add_action, add_filter, etc.)
                        'name' => $match['name'], // The hook name
                        'callback' => [$instance, $method->getName()], // The method to be used as the callback
                        'priority' => $match['priority'] ?? 10, // The priority of the hook (default to 10 if not specified)
                        'args' => $method->getNumberOfParameters(), // The number of arguments the callback method accepts
                    ];
                }
            }
        }

        return $handlers;
    }
}
