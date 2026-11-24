<?php

namespace iEducar\Packages\BuritiEscolarAderencia\Services;

/**
 * Roteiro binário PoC 5.3: matrícula → diário → boletim → atas.
 */
final class FluxoEscolarPoC
{
    /**
     * @return list<array{passo: int, id: string, titulo: string, evidencia: string, status_esperado: string}>
     */
    public function passos(): array
    {
        return [
            [
                'passo' => 1,
                'id' => 'matricula',
                'titulo' => 'Cadastro/consulta de matrícula ativa',
                'evidencia' => 'Tela aluno + matrícula (núcleo pmieducar)',
                'status_esperado' => 'atende',
            ],
            [
                'passo' => 2,
                'id' => 'diario',
                'titulo' => 'Lançamento de frequência/notas no diário',
                'evidencia' => 'i-Diário / módulos de notas do núcleo',
                'status_esperado' => 'atende',
            ],
            [
                'passo' => 3,
                'id' => 'boletim',
                'titulo' => 'Emissão de boletim / notas parciais',
                'evidencia' => 'Relatórios Portabilis/Serventec + exportação unificada',
                'status_esperado' => 'atende',
            ],
            [
                'passo' => 4,
                'id' => 'atas',
                'titulo' => 'Ata de resultado com marca d\'água',
                'evidencia' => 'MarcaDagua + Exportador (Onda 0)',
                'status_esperado' => 'parcial',
            ],
            [
                'passo' => 5,
                'id' => 'uniforme',
                'titulo' => 'Medidas e recebimento de uniforme',
                'evidencia' => 'UniformDistribution + UniformeMedidas',
                'status_esperado' => 'atende',
            ],
            [
                'passo' => 6,
                'id' => 'gabarito',
                'titulo' => 'Gabarito/correção de prova',
                'evidencia' => 'GabaritoProva (motor); UI/scan = gap fino',
                'status_esperado' => 'parcial',
            ],
        ];
    }

    public function totalPassos(): int
    {
        return count($this->passos());
    }
}
