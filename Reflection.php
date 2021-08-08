<?php

include 'Person.php';

/**
 * function to get info from a class using reflection class
 */
function printClassInfo($object)
{
    $reflection = new \ReflectionClass($object);

    echo "Class Name: " . $reflection->getName() . "<br/>";
    echo "Short Class Name: " . $reflection->getShortName() . "<br/>";

    echo "------------------------------------------" . "<br/>";

    echo "Contanst: " . "<br/>";
    foreach ($reflection->getConstants() as $key => $value) {
        echo $key . ' = ' . $value . "<br/>";
    }

    echo "------------------------------------------" . "<br/>";

    echo "Properties: " . "<br/>";

    foreach ($reflection->getProperties() as $property) {
        // list of method modifiers (public, static, ..)
        $propModifiers = \Reflection::getModifierNames($property->getModifiers());

        // echo all modifiers with space
        foreach ($propModifiers as $modifier) {
            echo $modifier . " ";
        }

        /**
         * this method of Reflection Property class make possible to access private or protected data on classes
         */
        $property->setAccessible(true);

        echo $property->getName() . ' = ' . json_encode($property->getValue($object)) . "<br/>";
    }

    echo "------------------------------------------" . "<br/>";

    echo "Methods: " . "<br/>";

    foreach ($reflection->getMethods() as $method) {
        // list of method modifiers (public, static, ..)
        $methodModifiers = \Reflection::getModifierNames($method->getModifiers());

        // echo all modifiers with space
        foreach ($methodModifiers as $modifier) {
            echo $modifier . " ";
        }

        echo $method->getName();

        $params = [];
        foreach ($method->getParameters() as $methodParam) {
            $currentParam = $methodParam->getName();

            if ($methodParam->isDefaultValueAvailable()) {
                $currentParam .= '=' . $methodParam->getDefaultValue();
                if ($methodParam->isDefaultValueConstant()) {
                    $currentParam .= '(' . $methodParam->getDefaultValueConstantName() . ')';
                }
            }

            $params[] = $currentParam;
        }

        // glue together pairs param name - default value if any
        echo '(' . implode(',', $params) . ')';

        echo "<br/>";
    }
}

/**
 * print info from class person
 */
printClassInfo(new Person('Salman Saputra'));