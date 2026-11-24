# Matriz PoC — 5.3 Escolar (Onda 1)

Classificação por **blocos funcionais** (196 itens OCR; detalhe fino na PoC).  
Legenda: **atende** · **parcial** · **gap**

| Bloco | Itens típicos | Status | Evidência |
| --- | --- | --- | --- |
| Calendário / base / avaliação | 5.3.1–5.3.9 | **atende** | Núcleo pmieducar |
| Frequência / notas / histórico / matrícula / turmas | 5.3.12–5.3.27 | **atende** | Núcleo + i-Diário |
| Compra de vagas / mensalidades | 5.3.28 | **gap** | Fora do núcleo padrão |
| Relatórios de alunos/notas/frequência/boletim | 5.3.29–5.3.70 | **parcial→atende** | Reports + export Onda 0 |
| Uniformes medidas/recebimento | 5.3.44–45, 5.3.194 | **atende** | `UniformDistribution` + `UniformeMedidas` |
| Atas com marca d'água | 5.3.35 (+ reforço) | **parcial** | `MarcaDagua` (JPEG); ligar em todas as atas |
| Gabarito / provas escaneadas | (executivo) | **parcial** | `GabaritoProva` motor; UI/scan gap |
| Secundárias no diário | (executivo) | **parcial** | Validar i-Diário na homologação |
| Anexos móveis | (executivo) | **gap** | Depende apps 5.13/5.14 |
| Ocorrências / amparos / atestados | vários | **atende** | Núcleo |

**Estimativa Onda 1:** ≥ **85%** demonstrável se roteiro matrícula→diário→boletim→atas + uniforme for ensaiado; gaps duros: compra de vagas, anexos móveis, UI gabarito/scan.

## Artefatos

```bash
php packages/buriti/i-educar-escolar-aderencia-package/tests/run.php
php artisan escolar:onda1-demo
```
