<?php

namespace iEducar\Packages\BuritiEscolarAderencia\Services;

/**
 * Gabarito de provas (TR 5.3 — provas/gabarito).
 * Aceita mapa questão→alternativa e calcula acertos contra respostas do aluno.
 */
final class GabaritoProva
{
    /** @param array<int|string, string> $gabarito */
    public function __construct(
        private readonly array $gabarito,
        private readonly string $titulo = 'Prova',
    ) {
        if ($gabarito === []) {
            throw new \InvalidArgumentException('Gabarito vazio.');
        }
        foreach ($gabarito as $q => $alt) {
            if (! is_string($alt) || $alt === '') {
                throw new \InvalidArgumentException("Alternativa inválida na questão {$q}.");
            }
        }
    }

    /**
     * @param array<int|string, string> $respostas
     * @return array{titulo: string, total: int, acertos: int, erros: int, percentual: float, detalhe: array<int|string, bool>}
     */
    public function corrigir(array $respostas): array
    {
        $detalhe = [];
        $acertos = 0;
        foreach ($this->gabarito as $q => $alt) {
            $ok = isset($respostas[$q]) && strcasecmp(trim((string) $respostas[$q]), trim($alt)) === 0;
            $detalhe[$q] = $ok;
            if ($ok) {
                $acertos++;
            }
        }
        $total = count($this->gabarito);

        return [
            'titulo' => $this->titulo,
            'total' => $total,
            'acertos' => $acertos,
            'erros' => $total - $acertos,
            'percentual' => $total > 0 ? round(($acertos / $total) * 100, 2) : 0.0,
            'detalhe' => $detalhe,
        ];
    }

    /**
     * @return array<int|string, string>
     */
    public static function fromCsv(string $csv): array
    {
        $map = [];
        foreach (preg_split('/\R/', trim($csv)) ?: [] as $linha) {
            $linha = trim($linha);
            if ($linha === '' || str_starts_with($linha, '#')) {
                continue;
            }
            [$q, $alt] = array_pad(preg_split('/[;,\t]/', $linha) ?: [], 2, '');
            $q = trim((string) $q);
            $alt = trim((string) $alt);
            if ($q === '' || $alt === '') {
                throw new \InvalidArgumentException("Linha de gabarito inválida: {$linha}");
            }
            $map[$q] = $alt;
        }

        return $map;
    }
}
