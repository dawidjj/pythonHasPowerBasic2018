<?php

class Triangle
{
    public function calculateSurfaceArea(
        array $coordinates
    ) : float {
        $this->validate(
            $coordinates
        );

        $ab = $this->getVectors(
            $coordinates[0],
            $coordinates[1]
        );

        $ac = $this->getVectors(
            $coordinates[0],
            $coordinates[2]
        );

        return 0.5 * abs(
            $this->calculate(
                $ab,
                $ac
            )
        );
    }

    private function validate(
        array $coordinates
    ) : void {
        if (count($coordinates) != 3) {
            throw new \Exception(
                'There are no 3 coordinates '
                .var_export(
                    $coordinates,
                    true
                )
            );
        }

        $expectIndex = 0;
        foreach ($coordinates as $index => $coordinate) {
            if (!array_key_exists(0, $coordinate)
                || !array_key_exists(1, $coordinate)
                || count($coordinate) != 2
                || $expectIndex != $index
            ) {
                throw new \Exception(
                    'Bad values '
                    .var_export(
                        $coordinates,
                        true
                    )
                );
            }

            $expectIndex++;
        }
    }

    private function getVectors(
        array $firstCoordinate,
        array $secondCoordinate
    ) : array {
        return [
            $secondCoordinate[0] - $firstCoordinate[0],
            $secondCoordinate[1] - $firstCoordinate[1]
        ];
    }

    private function calculate(
        array $firstCoordinate,
        array $secondCoordinate
    ) : float {
        return ($firstCoordinate[0] * $secondCoordinate[1])
            - ($firstCoordinate[1] * $secondCoordinate[0]);
    }
}

$s = new Triangle();
echo $s->calculateSurfaceArea([[-3,1], [0,-2], [2,4]]);
echo $s->calculateSurfaceArea([[0,0], [10,10], [10,0]]);