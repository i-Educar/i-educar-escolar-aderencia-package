#!/usr/bin/env php
<?php

declare(strict_types=1);

use iEducar\Packages\BuritiEscolarAderencia\Services\FluxoEscolarPoC;
use iEducar\Packages\BuritiEscolarAderencia\Services\GabaritoProva;
use iEducar\Packages\BuritiEscolarAderencia\Services\MarcaDagua;
use iEducar\Packages\BuritiEscolarAderencia\Services\UniformeMedidas;

require __DIR__.'/../src/Services/GabaritoProva.php';
require __DIR__.'/../src/Services/MarcaDagua.php';
require __DIR__.'/../src/Services/UniformeMedidas.php';
require __DIR__.'/../src/Services/FluxoEscolarPoC.php';

$ok = 0;
$fail = 0;
$assert = static function (bool $cond, string $msg) use (&$ok, &$fail): void {
    if ($cond) {
        echo "  OK  {$msg}\n";
        $ok++;
    } else {
        echo " FAIL {$msg}\n";
        $fail++;
    }
};

$g = new GabaritoProva(GabaritoProva::fromCsv("1;A\n2;B"), 'T');
$r = $g->corrigir([1 => 'A', 2 => 'C']);
$assert($r['acertos'] === 1 && $r['erros'] === 1, 'gabarito corrige 1 acerto / 1 erro');
$assert($r['percentual'] === 50.0, 'gabarito percentual 50');

$threw = false;
try {
    new GabaritoProva([]);
} catch (InvalidArgumentException) {
    $threw = true;
}
$assert($threw, 'gabarito vazio lança');

$u = new UniformeMedidas();
$linha = $u->normalizar([
    'student_id' => 10,
    'year' => 2026,
    'complete_kit' => true,
    'shirt_short_tm' => 'M',
    'coat_jacket_tm' => 'G',
    'pants_jeans_tm' => '42',
    'sneakers_tm' => '39',
    'distribution_date' => '10/02/2026',
]);
$assert($linha['camisa'] === 'M' && $linha['calcado'] === '39', 'uniforme normaliza medidas');
$cons = $u->consolidar([$linha, $u->normalizar(['student_id' => 2, 'year' => 2026, 'complete_kit' => false])]);
$assert($cons['total'] === 2 && $cons['kit_completo'] === 1, 'uniforme consolida');

$dir = sys_get_temp_dir().'/escolar-onda1-test-'.getmypid();
@mkdir($dir);
$base = $dir.'/in.jpg';
$out = $dir.'/out.jpg';
$img = imagecreatetruecolor(200, 100);
imagefilledrectangle($img, 0, 0, 200, 100, imagecolorallocate($img, 255, 255, 255));
imagejpeg($img, $base);
imagedestroy($img);
$m = new MarcaDagua();
$m->aplicarJpeg($base, $out, $m->textoPadraoAta('Escola', '2026'));
$assert(is_file($out) && filesize($out) > 0, 'marca d\'água gera JPEG');

$f = new FluxoEscolarPoC();
$assert($f->totalPassos() >= 4, 'fluxo PoC tem ≥ 4 passos');
$ids = array_column($f->passos(), 'id');
$assert(in_array('matricula', $ids, true) && in_array('atas', $ids, true), 'fluxo cobre matrícula e atas');

echo "\nResultado: {$ok} ok, {$fail} falhas\n";
exit($fail > 0 ? 1 : 0);
