<?php

namespace App\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;

class DateToStringTransformer implements DataTransformerInterface
{
    public function transform($dateObj)
    {
        $dateObj = $dateObj->getAteliers();
        if (null === $dateObj->getDateAtelier()) {
            return "";
        }
        
        // dd($dateObj->getDateatelier()->format('d/m/Y H:i'));
        return $dateObj->getDateAtelier()->format('d/m/Y H:i');
    }

    public function reverseTransform($date)
    {
        if ($date === "") {
            return null;
        }
        $dateObj = new \DateTime($date);

        return $dateObj;
    }
}