<?php

/** @var \Smart\Resale\Entity\Brand[] $brandList */

foreach ($brandList as $brand) {
    echo "
        <tr>
            <td>{$brand->getId()}</td>
            <td>{$brand->getBrandName()}</td>
            <td>R$ 15000,00</td>
            <td>R$ 1000,00</td>
            <td>16</td>
            <td>
                <a 
                    title='Editar'
                    style='color: #FFFFFF; background-color: #2582da; padding: .7rem; border-radius: .5rem; margin-right: 1rem;' 
                    href='/?{$brand->getId()}'><i class='fa-solid fa-pen-to-square'></i></a>
                <a 
                    title='Deletar'
                    style='color: #FFFFFF; background-color: #ec0707; padding: .7rem; border-radius: .5rem' 
                    href='/?{$brand->getId()}'><i class='fa-solid fa-trash'></i></a>
            </td>
        </tr>
    ";
}
