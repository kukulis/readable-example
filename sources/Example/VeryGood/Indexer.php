<?php

namespace Example\VeryGood;
class Indexer
{
    public static function reindex(array $elements, callable $indexGetter)
    {
        $result = [];
        foreach ($elements as $element) {
            $index = call_user_func($indexGetter, $element);
            $result[$index] = $element;
        }

        return $result;
    }

    public static function applyWhenMatch(
        array    $elements,
        array    $sourceElements,
        callable $sourceKeyGetter,
        callable $destinationKeyGetter,
        callable $action
    )
    {
        $indexedSources = self::reindex($sourceElements, $sourceKeyGetter);
        foreach ($elements as $element) {
            $destinationKey = call_user_func($destinationKeyGetter, $element);
            if (!array_key_exists($destinationKey, $indexedSources)) {
                continue;
            }
            call_user_func($action, $element, $indexedSources[$destinationKey]);
        }
    }
}