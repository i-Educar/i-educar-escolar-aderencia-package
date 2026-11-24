<?php

namespace iEducar\Packages\BuritiEscolarAderencia\Console;

use iEducar\Packages\BuritiEscolarAderencia\Services\FluxoEscolarPoC;
use iEducar\Packages\BuritiEscolarAderencia\Services\GabaritoProva;
use iEducar\Packages\BuritiEscolarAderencia\Services\MarcaDagua;
use iEducar\Packages\BuritiEscolarAderencia\Services\UniformeMedidas;
use Illuminate\Console\Command;

class Onda1EscolarDemoCommand extends Command
{
    protected $signature = 'escolar:onda1-demo {--dir= : Diretório de saída}';

    protected $description = 'Onda 1 — demo escolar (gabarito, uniforme, marca d\'água, fluxo PoC)';

    public function handle(MarcaDagua $marca, UniformeMedidas $uniforme, FluxoEscolarPoC $fluxo): int
    {
        $dir = $this->option('dir') ?: storage_path('app/escolar-onda1');
        if (! is_dir($dir) && ! mkdir($dir, 0775, true) && ! is_dir($dir)) {
            $this->error("Não criou {$dir}");

            return self::FAILURE;
        }

        $this->info('Onda 1 — escolar aderência');
        $this->line('Destino: '.$dir);

        // 1) Gabarito
        $gabarito = new GabaritoProva(GabaritoProva::fromCsv("1;A\n2;C\n3;B\n4;D"), 'Prova demo Laguna');
        $correcao = $gabarito->corrigir([1 => 'A', 2 => 'C', 3 => 'A', 4 => 'D']);
        file_put_contents($dir.'/gabarito-resultado.json', json_encode($correcao, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->line(sprintf('  ✓ gabarito: %d/%d (%.1f%%)', $correcao['acertos'], $correcao['total'], $correcao['percentual']));

        // 2) Uniforme consolidado
        $linhas = [
            $uniforme->normalizar([
                'student_id' => 1,
                'year' => 2026,
                'complete_kit' => true,
                'shirt_short_tm' => 'M',
                'coat_jacket_tm' => 'G',
                'pants_jeans_tm' => '40',
                'sneakers_tm' => '38',
                'distribution_date' => '01/03/2026',
            ]),
            $uniforme->normalizar([
                'student_id' => 2,
                'year' => 2026,
                'complete_kit' => false,
                'shirt_short_tm' => 'P',
                'sneakers_tm' => null,
            ]),
        ];
        $cons = $uniforme->consolidar($linhas);
        file_put_contents($dir.'/uniforme-consolidado.json', json_encode(['linhas' => $linhas, 'resumo' => $cons], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->line(sprintf('  ✓ uniforme: %d registros, %d kit completo', $cons['total'], $cons['kit_completo']));

        // 3) Marca d'água em JPEG sintético
        $base = $dir.'/ata-base.jpg';
        $out = $dir.'/ata-marca.jpg';
        $img = imagecreatetruecolor(640, 360);
        $bg = imagecolorallocate($img, 245, 245, 245);
        $fg = imagecolorallocate($img, 30, 30, 30);
        imagefilledrectangle($img, 0, 0, 640, 360, $bg);
        imagestring($img, 5, 40, 160, 'ATA DE RESULTADO FINAL - DEMO', $fg);
        imagejpeg($img, $base, 90);
        imagedestroy($img);
        $marca->aplicarJpeg($base, $out, $marca->textoPadraoAta('EMEF Demo Laguna', '2026'));
        $this->line('  ✓ marca d\'água: '.basename($out).' ('.filesize($out).' bytes)');

        // 4) Fluxo PoC
        $passos = $fluxo->passos();
        file_put_contents($dir.'/fluxo-poc.json', json_encode($passos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->line('  ✓ fluxo PoC: '.$fluxo->totalPassos().' passos');

        $this->info('Gate Onda 1.1 (demo escolar) OK.');

        return self::SUCCESS;
    }
}
