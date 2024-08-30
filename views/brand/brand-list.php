<?php

/** @var \Smart\Resale\Entity\Brand[] $brandList */

foreach ($brandList as $brand) {
    echo "
        <tr>
            <td>{$brand->getId()}</td>
            <td>{$brand->getBrandName()}</td>
            <td>R$ 15000,00</td>
            <td>R$ 1000,00</td>
        </tr>
    ";
}
