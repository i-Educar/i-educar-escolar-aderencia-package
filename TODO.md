# TODO — Aderência Escolar / Gestão (gaps 5.3)

> Pacote: `buriti/i-educar-escolar-aderencia-package` · TR **5.3** · Prioridade **P1**

## Backlog Laguna

- [ ] Montar matriz 5.3.x
- [ ] Classificar A/B/C por item
- [ ] Implementar top gaps que impedem 85%
- [ ] Gabarito/provas
- [ ] Uniformes
- [ ] Compra de vagas
- [ ] Marca d’água atas
- [ ] Anexos móveis
- [ ] Roteiro PoC escolar

## Scaffold 2.12 (quando iniciar código)

- [ ] `composer.json` (`buriti/…`, PHP ≥8.3, illuminate/support, `compatible: ["2.12"]`)
- [ ] `ServiceProvider` + `const PACKAGE`
- [ ] `routes/web.php` com middleware i-Educar
- [ ] Migrations no schema do domínio + guard `PackageTenant`
- [ ] Processos/menu (faixa própria)
- [ ] README + INSTALL espelhando transporte/setup
- [ ] Entrada futura em `packages/plug-and-play.json` (fora do ignore)
- [ ] Revisar `packages/buriti/PADRAO-PACOTE-2.12.md`

## Cobertura 100% do TR

- [ ] Percorrer 100% de [`REQUISITOS-TR.md`](./REQUISITOS-TR.md) (196 itens) e marcar atende/gap/N/A

- [ ] Abrir tarefas para **cada gap** (ou agrupar com IDs explícitos)

- [ ] Evidências de PoC por item atende

- [ ] Lista dos ≤15% com datas ≤30 dias

### Lotes (mesmo do ROADMAP)

- [ ] Lote R1: 5.3.1 … 5.3.16

- [ ] Lote R2: 5.3.17 … 5.3.31

- [ ] Lote R3: 5.3.32 … 5.3.46

- [ ] Lote R4: 5.3.47 … 5.3.61

- [ ] Lote R5: 5.3.62 … 5.3.76

- [ ] Lote R6: 5.3.77 … 5.3.91

- [ ] Lote R7: 5.3.92 … 5.3.106

- [ ] Lote R8: 5.3.107 … 5.3.126

- [ ] Lote R9: 5.3.127 … 5.3.141

- [ ] Lote R10: 5.3.142 … 5.3.156

- [ ] Lote R11: 5.3.157 … 5.3.172

- [ ] Lote R12: 5.3.173 … 5.3.188

- [ ] Lote R13: 5.3.189 … 5.3.204

- [ ] Lote R14: 5.3.205 … 5.3.205

## Gate PoC

- [ ] `REQUISITOS-TR.md` 100% classificado
- [ ] ≥ 85% atende com evidência
- [ ] ≤ 15% gap com plano ≤ 30 dias
- [ ] Roteiro binário ensaiado

## Referências

- `tmp/DOC-EXECUTIVO-PE-77-2026-LAGUNA-IEDUCAR.md`
- OCR: `/tmp/edital-ocr/p-01.txt` … `p-79.txt` (quando disponível)
