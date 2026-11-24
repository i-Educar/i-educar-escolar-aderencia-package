<?php

namespace iEducar\Packages\BuritiEscolarAderencia\Services;

/**
 * Marca d'água textual para atas/documentos (TR 5.3 — atas com marca).
 * Opera em JPEG via GD; PDF usa o mesmo texto na camada de overlay do exportador.
 */
final class MarcaDagua
{
    public function aplicarJpeg(string $caminhoEntrada, string $caminhoSaida, string $texto): void
    {
        if (! is_file($caminhoEntrada)) {
            throw new \InvalidArgumentException("Arquivo não encontrado: {$caminhoEntrada}");
        }

        $img = @imagecreatefromjpeg($caminhoEntrada);
        if ($img === false) {
            throw new \RuntimeException('Não foi possível abrir JPEG de entrada.');
        }

        $w = imagesx($img);
        $h = imagesy($img);
        $cor = imagecolorallocatealpha($img, 80, 80, 80, 70);
        $fonte = 5;
        $tw = imagefontwidth($fonte) * strlen($texto);
        $th = imagefontheight($fonte);

        for ($y = $th; $y < $h; $y += (int) ($h / 4)) {
            for ($x = 10; $x < $w; $x += max($tw + 40, 120)) {
                imagestring($img, $fonte, $x, $y, $texto, $cor);
            }
        }

        if (! imagejpeg($img, $caminhoSaida, 85)) {
            imagedestroy($img);
            throw new \RuntimeException('Falha ao gravar JPEG com marca d\'água.');
        }
        imagedestroy($img);
    }

    public function textoPadraoAta(string $escola, string $ano): string
    {
        return sprintf('ATA OFICIAL · %s · %s · SEM VALOR SEM ASSINATURA', mb_strtoupper($escola), $ano);
    }
}
