<?php

namespace App\Trait;

trait CorrespondenceTrait
{
    public function getSearchCorrespondence(): array
    {
        return ['Ä', 'Å', 'Â', 'Á', 'À', 'â', 'ä', 'á', 'à', 'ã', 'Æ', 'æ', 'ß', 'ç', 'Ç', 'Î', 'Ï', 'Í', 'Ì', 'ï', 'î', 'ì', 'í', '€', 'Ê', 'Ë', 'É', 'È', 'ê', 'ë', 'é', 'è', 'Û', 'Ü', 'Ú', 'Ù', 'ü', 'û', 'ú', 'ù', 'Ô', 'Ö', 'Ó', 'Ò', 'ö', 'ô', 'ó', 'ò', 'Œ', 'œ', 'ñ', 'Ñ', 'ý', 'Ý', 'ÿ', ' ', '\n', '\r'];
    }

    public function getChangeCorrespondence(): array
    {
        return ['A', 'A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'AE', 'ae', 'SS', 'C', 'C', 'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'E', 'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e', 'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u', 'O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'OE', 'oe', 'N', 'N', 'Y', 'Y', 'Y', '_', '+', '+'];
    }
}