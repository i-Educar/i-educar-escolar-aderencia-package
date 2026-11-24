<?php

namespace iEducar\Packages\BuritiEscolarAderencia\Services;

/**
 * Normaliza medidas/recebimento de uniforme (TR 5.3.44 / 5.3.45 / 5.3.194)
 * a partir do modelo núcleo UniformDistribution.
 *
 * @phpstan-type LinhaUniforme array{
 *   aluno_id: int,
 *   ano: int,
 *   kit_completo: bool,
 *   camisa: string|null,
 *   casaco: string|null,
 *   calca: string|null,
 *   calcado: string|null,
 *   data: string|null
 * }
 */
final class UniformeMedidas
{
    /**
     * @param object{
     *   student_id?: mixed,
     *   year?: mixed,
     *   complete_kit?: mixed,
     *   shirt_short_tm?: mixed,
     *   coat_jacket_tm?: mixed,
     *   coat_pants_tm?: mixed,
     *   pants_jeans_tm?: mixed,
     *   sneakers_tm?: mixed,
     *   distribution_date?: mixed
     * }|array<string, mixed> $registro
     * @return LinhaUniforme
     */
    public function normalizar(object|array $registro): array
    {
        $g = static fn (string $k): mixed => is_array($registro) ? ($registro[$k] ?? null) : ($registro->{$k} ?? null);

        $data = $g('distribution_date');
        if ($data instanceof \DateTimeInterface) {
            $data = $data->format('d/m/Y');
        }

        return [
            'aluno_id' => (int) $g('student_id'),
            'ano' => (int) $g('year'),
            'kit_completo' => (bool) $g('complete_kit'),
            'camisa' => $this->str($g('shirt_short_tm') ?? $g('shirt_long_tm')),
            'casaco' => $this->str($g('coat_jacket_tm') ?? $g('coat_pants_tm')),
            'calca' => $this->str($g('pants_jeans_tm') ?? $g('coat_pants_tm')),
            'calcado' => $this->str($g('sneakers_tm')),
            'data' => $data !== null ? (string) $data : null,
        ];
    }

    /**
     * @param list<LinhaUniforme> $linhas
     * @return array{total: int, kit_completo: int, com_medidas: int}
     */
    public function consolidar(array $linhas): array
    {
        $kit = 0;
        $med = 0;
        foreach ($linhas as $l) {
            if ($l['kit_completo']) {
                $kit++;
            }
            if ($l['camisa'] || $l['casaco'] || $l['calca'] || $l['calcado']) {
                $med++;
            }
        }

        return [
            'total' => count($linhas),
            'kit_completo' => $kit,
            'com_medidas' => $med,
        ];
    }

    private function str(mixed $v): ?string
    {
        if ($v === null || $v === '') {
            return null;
        }

        return (string) $v;
    }
}
