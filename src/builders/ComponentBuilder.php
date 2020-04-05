<?php
namespace RPF\Builders;

use RPF\core\Component;

final class ComponentBuilder
{
    public static function bring(string $name, string $id = "") {
        $path = findComponentPath($name);

        if ($id !== "")
        {
            return db()->query("SELECT * FROM $name WHERE id = ?", [$id])
            ->then(
                function(array $values) use ($name, $path) {
                    $components = [];
                    foreach ($values as $row) {
                        array_push($components,(new Component($name, $path, $row))->toArray());
                    }
                    return $components;
                }
            );
        }

        return db()->query("SELECT * FROM $name")
            ->then(
                function(array $values) use ($name, $path) {
                    $components = [];
                    foreach ($values as $row) {
                        array_push($components,(new Component($name, $path, $row))->toArray());
                    }
                    return $components;
                }
            );
    }
}