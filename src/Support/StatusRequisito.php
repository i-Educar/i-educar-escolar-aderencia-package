<?php

namespace iEducar\Packages\BuritiEscolarAderencia\Support;

enum StatusRequisito: string
{
    case Atende = 'atende';
    case Parcial = 'parcial';
    case Gap = 'gap';
    case Na = 'N/A';
}
