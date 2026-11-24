# EPIC — Aderência Escolar / Gestão (gaps 5.3)

| Campo | Valor |
| --- | --- |
| Pacote | `buriti/i-educar-escolar-aderencia-package` |
| TR Laguna | **5.3** |
| Prioridade | **P1** |
| Nota atual (executivo) | **A/B** |
| Fonte | `tmp/DOC-EXECUTIVO-PE-77-2026-LAGUNA-IEDUCAR.md` |
| Regra de ouro | Pregão Eletrônico 77/2026 · Laguna/SC · PoC ≥ 85% por módulo · gaps ≤ 30 dias |
| Base atual | i-Educar core + i-Diário + relatórios Portabilis/Serventec |

## Objetivo

Fechar gaps pontuais do TR escolar: gabarito/provas escaneadas, uniformes, compra de vagas, secundárias no diário, marca d’água, anexos móveis.

## Padrão técnico (i-Educar 2.12)

| Item | Valor |
| --- | --- |
| Alvo | i-Educar **2.12** · PHP **≥ 8.3** · Illuminate **^11|^12|^13** (Laravel 13 no app) |
| Composer | `buriti/i-educar-escolar-aderencia-package` |
| Namespace | `iEducar\Packages\BuritiEscolarAderencia\` → `src/` |
| Compat | `extra.ieducar.compatible: ["2.12"]` · GPL-2.0-or-later · `type: library` |
| Schema / dados | escolar_aderencia (só gaps: gabarito, uniforme, anexos…) — não forkar o core escolar |
| Rotas | prefixo `escolar-aderencia`; SME com middleware `ieducar.*` + `auth`; API apps via Sanctum quando exposto |
| Tenancy | `PackageTenant::allows('buriti/i-educar-escolar-aderencia-package')` antes de migrations/menu |
| Plug-and-play | path em `packages/buriti/…`; manter em `ignore` até instalável |
| Referência | `packages/buriti/PADRAO-PACOTE-2.12.md` |

**Nota de arquitetura:** Pacote de fechamento TR 5.3 sobre core + i-Diário + reports; patches cirúrgicos.

## Cobertura 100% do TR

Este EPIC cobre **todos** os requisitos do módulo(s) 5.3 listados em [`REQUISITOS-TR.md`](./REQUISITOS-TR.md) (196 itens OCR).

- PoC: ≥ **85%** demonstráveis e operacionais.
- Até **15%** restante: produção em ≤ **30 dias**, sem ônus.
- Nenhum item do `REQUISITOS-TR.md` pode ficar fora do `ROADMAP.md` / `TODO.md` (direto ou por grupo rastreável).

## Épicos filhos

1. Checklist ~200 itens OCR e priorização dos que derrubam o 85%.
2. Provas escaneadas/gabarito e anexos via app.
3. Uniformes, compra de vagas e fluxos de diário secundárias.
4. Marca d’água em atas e relatórios pontuais do edital.

## Critérios de aceite (PoC)

- [ ] Checklist [`REQUISITOS-TR.md`](./REQUISITOS-TR.md) com **100%** dos itens classificados (atende / gap / N/A)
- [ ] Itens **atende** demonstráveis na PoC (≥ 85% do módulo 5.3)
- [ ] Itens **gap** ≤ 15% com plano ≤ 30 dias em produção, sem ônus
- [ ] Nenhum requisito do TR omitido da matriz


## Fora de escopo deste EPIC

- Orçamento comercial da proposta Laguna.
- Substituição do core i-Educar fora do domínio do módulo.
